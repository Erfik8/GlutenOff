import React from 'react';
import UserSettings from './userSettings'; // Assuming this component is created
import HeaderMobile from '../Header/HeaderMobile';
import FooterMobile from '../Footer/FooterMobile';

const UserSettingsMobile = ({user}) => {
    return (
        <div>
            <HeaderMobile user={user}/>
            <main>
                <UserSettings user={user}/>
            </main>
            <FooterMobile user={user}/>
        </div>
    );
};

export default UserSettingsMobile;
