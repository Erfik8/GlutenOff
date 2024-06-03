import React, { useEffect, useState } from 'react';
import HeaderMobile from '../Header/HeaderMobile';
import ShopSearch from '../SearchComponent/ShopSearch';
//import ProductAddButton from './ProductAddButton';
import FooterMobile from '../Footer/FooterMobile';
import { useNavigate } from "react-router-dom";

const ShopInformation = () => {
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
        <div>
            <HeaderMobile user={user}/>
            <main>
                <ShopSearch user={user}/>
            </main>
            <FooterMobile user={user}/>
        </div>
    );
};

export default ShopInformation;