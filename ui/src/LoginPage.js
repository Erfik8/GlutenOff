import React, { useEffect, useState } from 'react';
import styles from './css/login.module.css';
import { useNavigate } from "react-router-dom";

function LoginPage() {
    const [messages, setMessages] = useState([]);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const navigate = useNavigate();

    document.getElementById('login').classList = '';
    document.getElementById('login').classList.add(styles.login);
    useEffect(() => {
        // Fetch data when the component mounts
        checkLoggedUser();
    }, []);

    const handleLoginSubmit = async (event) => {
        event.preventDefault();
        const loginData = {
            email: email,
            password: password
        };
        console.log(`${process.env.REACT_APP_API_URL}/login`)

        try {
            const response = await fetch(`${process.env.REACT_APP_API_URL}/login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(loginData)
            });

            if (response.ok) {
                const data = await response.json();
                localStorage.setItem("token", data.token);
                navigate("/dashboard", { replace: "true" });
            } else {
                // Handle errors, e.g., display error message
                console.error('Login failed');
            }
        } catch (error) {
            console.error('Error during login:', error);
        }
    };

    const registerPage = () => {
        window.location.href = 'http://localhost:3000/register';
    };

    const checkLoggedUser = async () => {
        if(localStorage.getItem('token'))
            {
                try {
                    const response = await fetch('http://localhost:8000/api/token_check', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization' : `Bearer ${localStorage.getItem('token')}`
                        }
                    });
                    if (!response.ok) {
                        if(response.status == 401)
                            {
                                console.log("Your login has been expired: relogin")
                            }
                        else  console.log(response.status);
                    }
                    else 
                    {
                        const data = await response.json();
                        console.log('Fetched user data:', data);
                        navigate("/dashboard", { replace: "true" })
                    }
                } catch (error) {
                    console.error('Fetching user data failed:', error);
                } finally {
                }

            }
    };

    return (
        <>
            <div className={styles.left_side}>
                <div className={styles.logo}>
                    <img src="/images/logo.svg" alt="logo" className={styles.logo} />
                    <h1 className={styles.Title}>GlutenOff</h1>
                </div>
                <ul>Sprawdź, które produkty są dla ciebie bezpieczne</ul>
                <br />
                <ul>Znajdź sklep polecany przez użytkowników</ul>
                <br />
                <ul>Podziel się opinią z innymi użytkownikami</ul>
            </div>
            <div className={styles.right_side}>
                <h4>Logowanie</h4>
                <form className={styles.login} onSubmit={handleLoginSubmit}>
                    {messages.map((message, index) => (
                        <div key={index}>{message}</div>
                    ))}
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Login"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                    <button type="submit" id="logowanie_zwykle">Zaloguj się</button>
                    <button type="button" id="Rejestracja" onClick={registerPage}>Zarejetruj się</button>
                </form>
            </div>
        </>
    );
}

export default LoginPage;
