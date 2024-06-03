import React from 'react';
import UserSettings from './userSettings';
import HeaderDesktop from '../Header/HeaderDesktop';
import ProfileBasicView from '../ProfileView/ProfileBasicView';

const UserSettingsDesktop = ({user}) => {
    return (
        <>
            <HeaderDesktop user={user} />
            <main>
                <UserSettings user={user}/>
            </main>
            <ProfileBasicView user={user} />
        </>
    );
};

export default UserSettingsDesktop;
