import { useEffect } from "react";
import React from 'react';
import styles from "../css/header-desktop.module.css"

function HeaderDesktop({ user }) {


    useEffect(()=>{
        document.getElementById('profile_basic_view').style.removeProperty('height');
    },[])
    var userLogo = '';
    if(!Array.isArray(user)) 
        {
            userLogo = JSON.parse(user).logo_link;
        }
    
    const showMenu = () => {
        document.getElementById('profile_basic_view').style.setProperty('width', '100vw');
    };

    return (
        <header className={styles.desktop}>
            <a href="/dashboard">
                <img src="/images/logo.svg" className={styles.logo} alt="logo" />
            </a>
            <div className={styles.header_bar}>
                <img className={styles.notification} src="/images/dzwoneczek.png" alt="powiadomienia" />
                <img
                    className={styles.profile}
                    //src={user.getLogoLink()}
                    src={userLogo}
                    alt="profil"
                    onClick={showMenu}
                />
            </div>
        </header>
    );
}

export default HeaderDesktop;
