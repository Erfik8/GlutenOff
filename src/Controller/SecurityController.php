<?php

// src/Controller/SecurityController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use App\Entity\Users;
use App\Entity\UserType;
use App\Entity\City;

class SecurityController extends AbstractController {
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        private readonly EntityManagerInterface $entityManager,
        private readonly TokenStorageInterface $tokenStorageInterface,
        private readonly JWTTokenManagerInterface $JWTManager,
        private HttpClientInterface $client,
      ){}

    
    #[Route('/login', name: "login", methods: ['POST'])]
    public function login(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];
            $user = $this->entityManager
            ->getRepository(Users::class)
            ->findOneBy(["email" => $email]);

            if (!$user) {
                return new JsonResponse(['success'=>false, 'user'=>$user], Response::HTTP_NOT_FOUND);
              }
              $token = $this->JWTManager->create($user);
            return new JsonResponse(['success'=>true, 'token' => $token], Response::HTTP_OK);

    }

    #[Route('/register', name: "register", methods: ['POST'])]
    public function register(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $name = $data['name'];
        $surname = $data['surname'];
        $password = $data['password'];
        $id_user_type = $data['id_user_type'];

        $user_type = $this->entityManager
            ->getRepository(UserType::class)
            ->findOneBy(["id" => $id_user_type]);

        $id_city = $data['id_city'];

        $city = $this->entityManager
            ->getRepository(City::class)
            ->findOneBy(["id" => $id_city]);

        $repeatPassword = $data['password2'];
    
        if ($password !== $repeatPassword) {
          throw new BadRequestException("Passwords do not match");
        }
    
        $find = $this->entityManager
          ->getRepository(Users::class)
          ->findBy(["email" => $email]);
    
        if ($find) {
          throw new BadRequestException("User already exists");
        }
    
        $user = new Users();
        $user->setEmail($email);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setIdUserType($user_type);
        $user->setIdCity($city);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $password));
    
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    
        if (!$user->getId()) {
          throw new \Exception('User was not saved correctly');
        }
    
        try {
          $token = $this->JWTManager->create($user);
        } catch (\Exception $e) {
          throw new BadRequestException("Token generation failed: " . $e->getMessage());
        }
    
        return new JsonResponse(['success'=>true, 'token'=>$token], Response::HTTP_CREATED);
    }

    #[Route('/logout', methods: ['POST'])]
    public function logout()
    {
        $request->getMethod();
    }
    #[Route('/api/token_check', methods: ['POST'])]
    public function getTokenUser(Request $request, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        $token = $request->headers->get('Authorization');
        $token = str_replace('Bearer ', '', $token);

        $parsedData = $JWTManager->parse($token);

        $find = $this->entityManager
          ->getRepository(Users::class)
          ->findOneBy(["email" => $parsedData['username']]);

        $response = $this->client->request(
            'GET',
            'http://localhost:8000/api/userss/'.$find->getId(),
            ['headers' => [
              'Authorization' => 'Bearer '.$token,
              'accept' => 'application/ld+json'
          ]]
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'

        return new JsonResponse(['token' => $parsedData['username'], 'user' => $content]);
    }
}