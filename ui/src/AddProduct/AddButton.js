import React from 'react';

const ProductAddButton = ({ userType,showAddForm }) => {

    return (
        <>
            {userType === 2 && (
                <div className={style.formButton} onClick={showAddForm}>
                    <img src="/images/plus.png" alt="plus" />
                </div>
            )}
        </>
    );
};

export default ProductAddButton;
