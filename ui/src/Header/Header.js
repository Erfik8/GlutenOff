import React from 'react';
import HeaderDesktop from './HeaderDesktop';
import HeaderMobile from './HeaderMobile';

function Header({ someAction, user }) {
    const isMobile = /Mobi|Android/i.test(navigator.userAgent);

    return isMobile ? (
        <HeaderMobile someAction={someAction} />
    ) : (
        <HeaderDesktop user={user} />
    );
}

export default Header;
