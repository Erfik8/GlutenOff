import React from 'react';
import styles from '../css/user_product_list.module.css'; // Adjust the path as needed

export function UserProductTitle() {
    return (
            <div className={[styles.title, styles.user_product_list].join(' ')}>
                <div className={styles.title_line_left}></div>
                <h3>Moja lista</h3>
                <div className={styles.title_line_right}></div>
            </div>
    );
}

export function UserProductList() {
    // Ideally, the images data should be passed as props or fetched from an API
    const images = [
        '/images/sloik.png',
        '/images/sloik.png',
        '/images/sloik.png',
        '/images/sloik.png',
        '/images/sloik.png',
        '/images/sloik.png',
    ];

    return (
            <div className={[styles.elements, styles.user_product_list].join(' ')}>
                {images.map((src, index) => (
                    <div className={styles.element_block} key={index}>
                        <a href="#">
                            <img src={src} alt="sloik" />
                        </a>
                    </div>
                ))}
            </div>
    );
};
