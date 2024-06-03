import React, { useState } from 'react';
import {UserProductList, UserProductTitle} from "../Lists/UserProductList.js";


import desktopStyles from '../css/desktop-profile_basic_view.module.css'; // Adjust the path as needed
import mobileStyles from '../css/mobile-profile_basic_view.module.css'; // Adjust the path as needed

const ProfileBasicView = ({ user }) => {

    let styles = desktopStyles;

    var userLogo = '';
    var userName = "Loading";
    var userSurname = "..."
    if(!Array.isArray(user)) 
        {
            userLogo = JSON.parse(user).logo_link;
            userName = JSON.parse(user).name;
            userSurname = JSON.parse(user).surname;
        }

    const isMobile = /Mobi|Android/i.test(navigator.userAgent);

    if (isMobile){
        styles = mobileStyles;
    }
    const hideMenu = () => {
        document.getElementById('profile_basic_view').style.setProperty('width','0vw');
    };

    const stopPropagation = (event) => {
        event.stopPropagation();
    };

    return (
     
        <section
            id="profile_basic_view"
            className={styles.profile_basic_view}
            onClick={hideMenu}
            style={{ width: '0vw', height:'0vh' }}
        >
            <div className={styles.profile_view_box} onClick={stopPropagation}>
                <img src={userLogo} alt="User Profile" />
                <h1>{userName} {userSurname}</h1>
                <div id="levelBar">
                    <div id="level_bar" className={styles.outer_level_bar}>
                        <span>Level: 12</span>
                        <div className={styles.inner_level_bar} style={{ width: '30%' }}></div>
                    </div>
                </div>
                <UserProductTitle />
                <UserProductList />
                <button type="button" className={styles.settings} onClick={() => window.location = '/userSettings'}>Ustawienia</button>
                <button type="button" className={styles.logout} onClick={() => window.location = '../logout'}>Wyloguj</button>
            </div>
        </section>
    );
};


export default ProfileBasicView;
