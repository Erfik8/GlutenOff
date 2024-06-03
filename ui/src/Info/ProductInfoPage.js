import React from 'react';
import { useEffect, useState } from 'react';
import {isMobile} from 'react-device-detect';
import { useNavigate } from "react-router-dom";
import ProductInformationMobile from './ProductInfoMobile';
import ProductInfoDesktop from './ProductInfoDesktop';

function ProductInfoPage() {

    const [user,setUser] = useState([]);
    const [product,setProduct] = useState([]);

    const navigate = useNavigate();

    useEffect(() => {
        checkLoggedUser();
        getMainProduct();
    }, []);

    const getMainProduct = async () => {
        const queryParameters = new URLSearchParams(window.location.search);
        const id = queryParameters.get("product_id");
        try {
            const response = await fetch(`http://localhost:8000/api/productss/${id}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (!response.ok) {
                console.error("Connection failed", response.text);
            }
            else 
            {
                const data = await response.json();
                console.log(data);
                setProduct(data);
            }
        } catch (error) {
            console.error('Fetching user data failed:', error);
        } finally {
        }
    }

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
                    <ProductInformationMobile user={user} product={product}/>
                </>
            ) : (
                <>
                    <ProductInfoDesktop user={user} product={product}/>
                </>
            )}
        </React.Suspense>
    );
}

export default ProductInfoPage;
