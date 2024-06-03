import React from 'react';
import styles from "../css/header-mobile.module.css"

function HeaderMobile({ user }) {
    return (
        <header className={styles.mobile}>
            <img
                src="/images/HamburgerButton.png"
                className={styles.hamburger}
                alt="hamburger"
            />
            <a href='/dashboard'>
                <img src="/images/logo.svg" className={styles.logo} alt="logo" />
            </a>
        </header>
    );
}

export default HeaderMobile;
