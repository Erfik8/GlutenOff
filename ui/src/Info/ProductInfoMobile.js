import React from 'react';
import HeaderMobile from '../Header/HeaderMobile';
//import ProductDescription from './ProductDescription';
import ProductAddButton from '../AddProduct/AddButton';
import FooterMobile from '../Footer/FooterMobile';
import style from '../css/products-mobile.module.css';
import ProductDescription from './ProductDescription';

const ProductInformationMobile = ({ user, product}) => {
    function showAddForm(){
        window.location.href = 'http://localhost:8080/addProduct';
    }

    return (
        <div>
            <HeaderMobile user={user} />
            <main className={style.main}>
                <ProductDescription mainProduct={product} style={style}/>
                <ProductAddButton showAddForm={showAddForm} userType={user.id_user_type.id}/>
            </main>
            <FooterMobile user={user}/>
        </div>
    );
};

export default ProductInformationMobile;
