import React from 'react';
import styles from '../css/dashboard-desktop.module.css'; // Adjust the path as needed
import ProductSearch from '../SearchComponent/ProductSearch';
import ShopSearch from '../SearchComponent/ShopSearch';
import ProfileBasicView from '../ProfileView/ProfileBasicView';

function DashboardDesktop({user}) {
    document.getElementById('login').classList = '';
    document.getElementById('login').classList.add(styles.dashboard_desktop)
    return (
        <main>
            <ProductSearch />
            <div className={styles.vertical_line}></div>
            <ShopSearch />
            <ProfileBasicView user={user} />
        </main>
    );
}

export default DashboardDesktop;
