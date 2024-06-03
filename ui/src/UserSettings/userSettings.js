import React, { useState, useEffect } from 'react';
import style from '../css/user_settings.module.css';

const UserSettings = ({ user}) => {
    const [id, setId] = useState('');
    const [name, setName] = useState('');
    const [surname, setSurname] = useState('');
    const [email, setEmail] = useState('');
    const [city, setCity] = useState('');
    const [logo, setLogo] = useState('');
    const [userType, setUserType] = useState('');
    const [premiumDate, setPremiumDate] = useState('');
    const [cities, setCities] = useState([]);

    useEffect(() => {
        if (!Array.isArray(user)) {
            const parseUser = JSON.parse(user);
            setId(parseUser.id);
            setName(parseUser.name);
            setSurname(parseUser.surname);
            setEmail(parseUser.email);
            setCity(parseUser.id_city.name);
            setLogo(parseUser.logo_link);
            setUserType(parseUser.id_user_type.name);
            if (parseUser.id_user_type.name === 'premium') {
                setPremiumDate(parseUser.premium_ending_date);
            }
        }
    }, [user]);
    
    /*var name  = ''
    var surname =''
    var email = ''
    var city = ''
    var logo = ''
    var userType = ''
    var premiumDate = ''
    const [cities,setCities] = useState([])

    if(!Array.isArray(user)) 
        {
            //console.log(user);
            var parseUser = JSON.parse(user);
            name = parseUser.name;
            surname = parseUser.surname;
            email = parseUser.email;
            city = parseUser.id_city.name;
            logo = parseUser.logo_link;
            userType = parseUser.id_user_type.name;
            premiumDate = userType == "premium" ? parseUser.premium_ending_date : '';
            console.log(premiumDate);
        }*/
    useEffect(()=>{
        getCities();
    },[]);

    const getCities = async () => {
        try {
            const response = await fetch('http://localhost:8000/api/cities.jsonld',{
                method: 'GET',
                headers: {
                    'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            setCities(data["hydra:member"]);
        } catch (error) {
            console.error('Fetching products data failed:', error);
        } finally {}
        
    }

    const handleLogoChange = (event) => {
        //const file = event.target.files[0];
        //const reader = new FileReader();
        //reader.onloadend = () => {
            //setLogo(reader.result);
        //};
        //reader.readAsDataURL(file);
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        const formData = new FormData();
        formData.append('name', name);
        formData.append('surname', surname);
        formData.append('email', email);
        formData.append('city', city);
        //formData.append('logo', event.target.logo.files[0]);
        const cityid = cities.filter(singlecity =>
            singlecity.name.includes(city)
        );

        console.log(Object.fromEntries(formData));
        console.log(JSON.stringify({
            name,
            surname,
            email,
            "id_city": cities[cityid[0].id]["@id"]
        }));
        
        //console.log(cityid.id)

        fetch(`http://localhost:8000/api/userss/${id}`, {
            method: 'PATCH',
            headers: {
                'Authorization' : `Bearer ${localStorage.getItem('token')}`,
                'Content-Type' : 'application/merge-patch+json'
            },
            body: 
            JSON.stringify({
                name,
                surname,
                email,
                "id_city": cities[cityid[0].id]["@id"]
            })
        })
        .then(response => response.json())
        .then(data => {
            // handle successful response
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    };

    return (
        <section className={style.user_settings}>
            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <div className={style.user_information}>
                    <div className={style.user_photo}>
                        <img id="logo-image" src={logo} alt="logo" />
                        <label htmlFor="logo-input">Edytuj zdjęcie</label>
                        <input
                            id="logo-input"
                            type="file"
                            name="logo"
                            accept="image/png, image/jpeg"
                            onChange={handleLogoChange}
                        />
                    </div>
                    <div className={style.user_description}>
                        <label htmlFor="name"> Imie: </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                        />
                        <label htmlFor="surname"> Nazwisko:</label>
                        <input
                            type="text"
                            name="surname"
                            id="surname"
                            value={surname}
                            onChange={(e) => setSurname(e.target.value)}
                        />
                        <label htmlFor="email"> email</label>
                        <input
                            type="text"
                            name="email"
                            id="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                        />
                        <label htmlFor="city">Miasto: </label>
                        <input
                            list="Cities"
                            name="city"
                            id="city"
                            value={city}
                            onChange={(e) => setCity(e.target.value)}
                            disabled={userType !== "premium"}
                        />
                        <datalist id="Cities">
                            {cities.map((city) => (
                                <option key={city.id} value={city.name} />
                            ))}
                        </datalist>
                    </div>
                </div>
                <label htmlFor="type">Typ użytkownika</label>
                <span>{userType}</span>
                {userType === "premium" ? (
                    <>
                        <label htmlFor="premium">Data okresu premium: {premiumDate} </label>
                        <span>{user.premiumEndingDate}</span>
                    </>
                ) : (
                    <button type="button">AKTYWUJ PREMIUM</button>
                )}
                <button type="submit" className={style.save}>Zapisz zmiany</button>
            </form>
        </section>
    );
};

export default UserSettings;
