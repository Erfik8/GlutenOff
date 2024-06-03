import React from 'react';
import { useEffect, useState } from 'react';
import HeaderMobile from '../Header/HeaderMobile';
import FooterMobile from '../Footer/FooterMobile';
import HeaderDesktop from '../Header/HeaderDesktop';
import DashboardMobile from './DashboardMobile';
import DashboardDesktop from './DashboardDesktop';
import {isMobile} from 'react-device-detect';
import { useNavigate } from "react-router-dom";

function Dashboard() {

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
        <div className="Dashboard">
            <React.Suspense fallback={<h2>🌀 Loading...</h2>}>
                {console.log(user)}
                {
                isMobile ? (
                    <>
                        <HeaderMobile user={user}/>
                        <DashboardMobile user={user}/>
                        <FooterMobile user={user}/>
                    </>
                ) : (
                    <>
                        <HeaderDesktop user={user}/>
                        <DashboardDesktop user={user}/>
                    </>
                )}
            </React.Suspense>

        </div>
    );
}

export default Dashboard;
