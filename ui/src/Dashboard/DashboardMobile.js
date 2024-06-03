import React from 'react';
import {UserProductList, UserProductTitle} from '../Lists/UserProductList';
import styles from '../css/dashboard-mobile.module.css'; // Adjust the path as needed

function DashboardMobile({user}) {
    document.getElementById('login').classList = '';
    document.getElementById('login').classList.add(styles.dashboard_mobile)

    return (
        <main>
            <div className={styles.title}>
                <div className={styles.title_line_left}></div>
                <h3>Historia wyszukiwania</h3>
                <div className={styles.title_line_right}></div>
            </div>
            <div className={styles.elements}>
                {Array(6).fill().map((_, index) => (
                    <div className={styles.element_block} key={index}>
                        <a href="#">
                            <img src="/images/sloik.png" alt="sloik" />
                        </a>
                    </div>
                ))}
            </div>
            <div className={styles.title}>
                <div className={styles.title_line_left}></div>
                <h3>Polecane Sklepy</h3>
                <div className={styles.title_line_right}></div>
            </div>
            <div className={styles.elements}>
                {Array(6).fill().map((_, index) => (
                    <div className={styles.element_block} key={index}>
                        <a href="#">
                            <img src="/images/sloik.png" alt="sloik" />
                        </a>
                    </div>
                ))}
            </div>
            <UserProductTitle />
            <UserProductList />
        </main>
    );
}

export default DashboardMobile;
