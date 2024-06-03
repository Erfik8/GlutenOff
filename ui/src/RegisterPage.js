import React, { useState, useEffect } from 'react';
import styles from './css/login.module.css';

function RegisterPage() {
    const [messages, setMessages] = useState([]);
    const [name, setName] = useState('');
    const [surname, setSurname] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [password2, setPassword2] = useState('');
    const [city, setCity] = useState('');
    const [cities, setCities] = useState([]);

    useEffect(() => {
        // Fetch city data here and update the cities state
        // Example: setCities([{ getName: () => 'City1' }, { getName: () => 'City2' }]);
    }, []);

    const handleRegisterSubmit = (event) => {
        event.preventDefault();
        // Add registration form validation and submission logic here
    };

    const loginPage = () => {
        window.location.href = 'http://localhost:3000/login';
    };

    return (
        <>
            <div className={styles.left_side}>
                <div className={styles.logo}>
                    <img src="public/images/logo.svg" alt="logo" className={styles.logo} />
                    <h1 className={styles.Title}>GlutenOff</h1>
                </div>
                <ul>Sprawdź, które produkty są dla ciebie bezpieczne</ul>
                <br />
                <ul>Znajdź sklep polecany przez użytkowników</ul>
                <br />
                <ul>Podziel się opinią z innymi użytkownikami</ul>
            </div>
            <div className={styles.right_side}>
                <h4>Rejestracja</h4>
                <form className={styles.register} onSubmit={handleRegisterSubmit}>
                    {messages.map((message, index) => (
                        <div key={index}>{message}</div>
                    ))}
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Name"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />
                    <input
                        type="text"
                        name="surname"
                        id="surname"
                        placeholder="Surname"
                        value={surname}
                        onChange={(e) => setSurname(e.target.value)}
                    />
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
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
                    <input
                        type="password"
                        name="password2"
                        id="password2"
                        placeholder="Confirm password"
                        value={password2}
                        onChange={(e) => setPassword2(e.target.value)}
                    />
                    <input
                        list="Cities"
                        name="city"
                        placeholder="City"
                        value={city}
                        onChange={(e) => setCity(e.target.value)}
                    />
                    <datalist id="Cities">
                        {cities.map((city, index) => (
                            <option key={index} value={city.getName()} />
                        ))}
                    </datalist>
                    <button type="submit" id="rejestracja">Utwórz konto</button>
                    <button type="button" id="logowanie" onClick={loginPage}>Zaloguj</button>
                </form>
            </div>
        </>
    );
}

export default RegisterPage;
