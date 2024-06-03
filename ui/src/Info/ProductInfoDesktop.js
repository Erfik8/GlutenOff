import React, { useEffect, useState } from 'react';
import AddProduct from '../AddProduct/AddProduct';
//import ProductDescription from './ProductDescription';
import ProductSearch from '../SearchComponent/ProductSearch';
import ProductAddButton from '../AddProduct/AddButton';
import ProfileBasicView from '../ProfileView/ProfileBasicView';
import style from '../css/products-desktop.module.css';
import HeaderDesktop from '../Header/HeaderDesktop';
import ProductDescription from './ProductDescription';



const ProductInfoDesktop = ({ user, product}) => {

    const [user_id, setUserId] = useState(0);
    
    useEffect(()=>{
        if (!Array.isArray(user)) {
            const parseUser = JSON.parse(user);
            setUserId(parseUser.id_user_type.id);
        }
}   ,[])

    function showAddForm(){
        if(!document.getElementById('product-description').classList.contains('disabled'))
        {
            document.getElementById('product-description').classList.add('disabled');
        }
        if(document.getElementById('product-add').classList.contains('disabled'))   
        {
            document.getElementById('product-add').classList.remove('disabled');
        }
    }

    return (
        <div>
            <HeaderDesktop user={user} />
            <main className={style.main}>
                <AddProduct mainProduct={product} style={style}/>
                <ProductDescription mainProduct={product} style={style} />
                <div className={style.vertical_line}></div>
                <ProductSearch />
                <ProductAddButton showAddForm={showAddForm} userType={user_id}/>
                <ProfileBasicView user={user} />
            </main>
        </div>
    );
};

export default ProductInfoDesktop;
