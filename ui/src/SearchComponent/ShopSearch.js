import React, { useEffect, useState } from 'react';
import styles from '../css/search-list.module.css'; // Adjust the path as needed

const ShopSearch = () => {
    const [searchTerm, setSearchTerm] = useState('');
    const [shops, setShops] = useState([]);

    const PUBLIC_ENTRY = "./..";

    useEffect(() => {
        // Fetch data when the component mounts
        fetchShopsData();
    }, []);


    const handleSearchChange = (event) => {
        setSearchTerm(event.target.value);
    };

    const filteredShops = shops.filter(shop =>
        shop.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

    const fetchShopsData = async () => {
        try {
            const response = await fetch('http://localhost:8000/api/shopss.jsonld',{
                method: 'GET',
                headers: {
                    'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            console.log('Fetched shops data:', data["hydra:member"]);
            setShops(data["hydra:member"]);
        } catch (error) {
            console.error('Fetching shops data failed:', error);
        } finally {
        }
    };


    return (
        <div className={styles.shop_search}>
            <div className={styles.input}>
                <input
                    type="text"
                    id="searchShopInput"
                    value={searchTerm}
                    onChange={handleSearchChange}
                    placeholder="Search shops..."
                />
                <img src="/images/search.png" alt="search" />
            </div>
            <div className={styles.shops_list} id="shops-list">
                {filteredShops.map(shop => (
                    <a href={`/shops?shop_id=${shop.id}`} key={shop.id}>
                        <div className={styles.shop_element}>
                            <img className={styles.shop_images} src={shop.logo_link} alt="produkt" />
                            <div className={styles.description}>
                                <h3>{shop.name}</h3>
                                <p>{shop.address}</p>
                                <p>Polecane: 2365</p>
                            </div>
                            <div className={styles.diet_list}>
                                <img
                                    src="/images/lactose.png"
                                    alt="lactose"
                                    className={[styles.diets,`${shop.isLactoseFree ? 'active' : 'deactive'}`].join(' ')}
                                />
                                <img
                                    src="/images/vegan.png"
                                    alt="vegan"
                                    className={[styles.diets,`${shop.isVegan ? 'active' : 'deactive'}`].join(' ')}
                                />
                                <img
                                    src="/images/vegetarian.png"
                                    alt="vegetarian"
                                    className={[styles.diets,`${shop.isVegetarian ? 'active' : 'deactive'}`].join(' ')}
                                />
                                <img
                                    src="/images/gluten.png"
                                    alt="gluten"
                                    className={[styles.diets,`${shop.isGlutenFree ? 'active' : 'deactive'}`].join(' ')}
                                />
                            </div>
                        </div>
                    </a>
                ))}
            </div>
        </div>
    );
};

export default ShopSearch;
