import React, { useEffect, useState } from 'react';


const ProductDescription = ({ style, mainProduct }) => {

    const [logoLink, setLogoLink] = useState('');
    const [name, setName] = useState('');
    const [companyName, setCompanyName] = useState('');
    const [description, setDescription] = useState('');
    const [isVegan, setVegan] = useState(false);
    const [isGlutenFree, setIsGlutenFree] = useState(false);
    const [isLactoseFree, setIsLactoseFree] = useState(false);
    const [isVegetarian, setIsVegetarian] = useState(false);

    useEffect(()=>{
        if (!Array.isArray(mainProduct)) {
            setLogoLink(mainProduct.logo_link);
            setName(mainProduct.name);
            setCompanyName(mainProduct.id_company.name);
            setDescription(mainProduct.description);
            setIsGlutenFree(mainProduct.gluten_free);
            setIsLactoseFree(mainProduct.lactose_free);
            setIsVegetarian(mainProduct.vegetarian);
            setVegan(mainProduct.vegan);
        }
    },[mainProduct])

    
    if (!mainProduct) {
        return <section className={`${style.informationBlock} ${style.disabled}`} id="product-description"></section>;
    }

    return (
        <section className={style.information_block} id="product-description">
            <img src={logoLink} alt="sloik" className={style.product_image} />
            <h1>{name}</h1>
            <div className={style.diet_information}>
                <img
                    src='/images/vegan.png'
                    alt="vegan"
                    className={isVegan ? style.active : style.deactive}
                />
                <img
                    src='/images/vegetarian.png'
                    alt="vegetarian"
                    className={isVegetarian ? style.active : style.deactive}
                />
                <img
                    src='/images/lactose.png'
                    alt="lactose free"
                    className={isLactoseFree ? style.active : style.deactive}
                />
                <img
                    src='/images/gluten.png'
                    alt="gluten free"
                    className={isGlutenFree ? style.active : style.deactive}
                />
            </div>
            <h3>Producent: {companyName}</h3>
            <span className={style.description}>{description}</span>
        </section>
    );
};

export default ProductDescription;
