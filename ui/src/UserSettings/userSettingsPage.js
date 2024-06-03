import React from 'react';
import { useEffect, useState } from 'react';
import {isMobile} from 'react-device-detect';
import { useNavigate } from "react-router-dom";
import UserSettingsMobile from './userSettingsMobile';
import UserSettingsDesktop from './userSettingsDesktop';

function UserSettingsPage() {

    const [user,setUser] = useState([]);

    const navigate = useNavigate();

    useEffect(() => {
        checkLoggedUser();
    }, []);

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
                                navigate("/login", { replace: "true" })
                            }
                        else  console.log(response.status);
                    }
                    else 
                    {
                        const data = await response.json();
                        console.log(data.user);
                        localStorage.setItem('user',JSON.parse(data.user));
                        setUser(data.user)
                    }
                } catch (error) {
                    console.error('Fetching user data failed:', error);
                } finally {
                }
            }
    };

    return (
        <React.Suspense fallback={<h2>🌀 Loading...</h2>}>
            {console.log(user)}
            {
            isMobile ? (
                <>
                    <UserSettingsMobile user={user}/>
                </>
            ) : (
                <>
                    <UserSettingsDesktop user={user}/>
                </>
            )}
        </React.Suspense>
    );
}

export default UserSettingsPage;
