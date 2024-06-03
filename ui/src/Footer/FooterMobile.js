import React, { useEffect } from 'react';
import styles from '../css/footer-mobile.module.css'; // Adjust the path as needed
import ProfileBasicView from '../ProfileView/ProfileBasicView';

function FooterMobile({ user }) {
    
    var userLogo = '';
    if(!Array.isArray(user)) 
        {
            userLogo = JSON.parse(user).logo_link;
        }
        
        useEffect(() => {
            console.log("dupa");
            document.getElementById('profile_basic_view').style.removeProperty('width');
        }, []);
        
        const showMenu = () => {
            if (document.getElementById('profile_basic_view').style.height == "0vh") {
                document.getElementById('user-element').style.setProperty('top',"120px");
                document.getElementById('user-element').getElementsByTagName('img')[0].style.setProperty('background-color',"white");
                document.getElementById('profile_basic_view').style.setProperty('height',"100vh");
            } else {
                document.getElementById('user-element').style.removeProperty("top");
                document.getElementById('user-element').getElementsByTagName('img')[0].style.removeProperty('background-color');
                document.getElementById('profile_basic_view').style.setProperty('height','0vh')
            }
        };
        
    return (
        <footer>
            <div className={styles.icon_element}>
                <a href="#"><img src="/images/dzwoneczek.png" alt="notification" /></a>
                <p>Powiadomienia</p>
            </div>
            <div className={styles.icon_element}>
                <a href="/products"><img src="/images/search.png" alt="search" /></a>
                <p>Szukaj Produktów</p>
            </div>
            <div className={styles.user_element} id="user-element" >
                <a href="#"><img src={userLogo} alt="profile" onClick={showMenu}  /></a>
                <div className="level-bar">
                    <div className="level-filler"></div>
                </div>
            </div>
            <div className={styles.icon_element}>
                <a href="/shops"><img src="/images/restaurant.png" alt="notification" /></a>
                <p>Restauracje</p>
            </div>
            <div className={styles.icon_element}>
                <a href="/settings"><img src="/images/settings.png" alt="settings" /></a>
                <p>Narzędzia</p>
            </div>
            <ProfileBasicView user={user}/>
        </footer>
    );
}

export default FooterMobile;
