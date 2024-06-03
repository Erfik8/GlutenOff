import React, { useEffect, useState } from 'react';
import styles from '../css/search-list.module.css'; // Adjust the path as needed

const ProductSearch = () => {
    const [searchTerm, setSearchTerm] = useState('');
    const [products, setProducts] = useState([]);

    const PUBLIC_ENTRY = "./..";

    useEffect(() => {
        fetchProductData();
    }, []);

    const handleSearchChange = (event) => {
        setSearchTerm(event.target.value);
    };

    const filteredProducts = products.filter(product =>
        product.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

    const fetchProductData = async () => {
        try {
            const response = await fetch('http://localhost:8000/api/productss.jsonld',{
                method: 'GET',
                headers: {
                    'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            console.log('Fetched products data:', data["hydra:member"]);
            setProducts(data["hydra:member"]);
        } catch (error) {
            console.error('Fetching products data failed:', error);
        } finally {
        }
    };



    

    return (
        <div className={styles.product_search}>
            <div className={styles.input}>
                <input
                    type="text"
                    id="searchProductInput"
                    value={searchTerm}
                    onChange={handleSearchChange}
                    placeholder="Search products..."
                />
                <img src="/images/search.png" alt="search" />
            </div>
            <div className={styles.products_list} id="products-list">
                {filteredProducts.map(product => (
                    <a href={`/products?product_id=${product.id}`} key={product.id}>
                        <div className={styles.product_element}>
                            <img className={styles.product_images} src={PUBLIC_ENTRY+product.logo_link} alt="produkt" />
                            <div className={styles.description}>
                                <h3>{product.name}</h3>
                                <p>{product.id_company.name}</p>
                            </div>
                        </div>
                    </a>
                ))}
            </div>
        </div>
    );
};

export default ProductSearch;
