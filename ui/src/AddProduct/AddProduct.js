import React, { useState, useEffect } from 'react';

const AddProduct = ({  style,mainProduct }) => {
    const [name, setName] = useState('');
    const [company, setCompany] = useState('');
    const [category, setCategory] = useState('');
    const [description, setDescription] = useState('');
    const [logo, setLogo] = useState(null);
    const [isVegan, setIsVegan] = useState(false);
    const [isVegetarian, setIsVegetarian] = useState(false);
    const [isLactoseFree, setIsLactoseFree] = useState(false);
    const [isGlutenFree, setIsGlutenFree] = useState(false);
    const [companyList, setCompanyList] = useState([]);
    const [categoryList, setCategoryList]= useState([]);


    useEffect(()=>{
        getCompanies();
        getCategories();
    },[])

    const handleLogoChange = (event) => {
        setLogo(event.target.files[0]);
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        //parsing data logic


        fetch('/addProduct', {
            method: 'POST',
            
        })
        .then(response => response.json())
        .then(data => {
            // handle successful response
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    };

    const getCompanies = async () => {
        try {
            const response = await fetch('http://localhost:8000/api/companies.jsonld',{
                method: 'GET',
                headers: {
                    'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            setCompanyList(data["hydra:member"]);
        } catch (error) {
            console.error('Fetching Companies data failed:', error);
        } finally {}
        
    }

    const getCategories = async () => {
        try {
            const response = await fetch('http://localhost:8000/api/categories.jsonld',{
                method: 'GET',
                headers: {
                    'Authorization' : `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            setCategoryList(data["hydra:member"]);
        } catch (error) {
            console.error('Fetching Categories data failed:', error);
        } finally {}
        
    }

    const toggleDietary = (setter, value) => {
        setter(!value);
    };

    return (
        <section className={`${style.information_block} ${mainProduct ? style.disabled : ''}`} id="product-add">
            <form onSubmit={handleSubmit} className={style.add_product} encType="multipart/form-data">
                <h1>Dodaj produkt</h1>

                <h3>Nazwa</h3>
                <input type="text" name="name" value={name} onChange={(e) => setName(e.target.value)} />

                <h3>Producent</h3>
                <input
                    type="text"
                    list="Companies"
                    name="company"
                    value={company}
                    onChange={(e) => setCompany(e.target.value)}
                />
                <datalist id="Companies">
                    {companyList.map((company) => (
                        <option key={company.name} value={company.name} />
                    ))}
                </datalist>

                <h3>Kategoria</h3>
                <input
                    list="categories"
                    name="category"
                    value={category}
                    onChange={(e) => setCategory(e.target.value)}
                />
                <datalist id="categories">
                    {categoryList.map((category) => (
                        <option key={category.name} value={category.name} />
                    ))}
                </datalist>

                <h3>Etykieta</h3>
                <input type="text" name="description" value={description} onChange={(e) => setDescription(e.target.value)} />

                <h3>Dodaj grafikę</h3>
                <input type="file" id="logo" name="logo" accept="image/png, image/jpeg" onChange={handleLogoChange} />

                <h5>Zaznacz przyciskiem diety dla danego produktu</h5>

                <div className={style.diet_group}>
                    <button
                        type="button"
                        onClick={() => toggleDietary(setIsVegan, isVegan)}
                        className={isVegan ? style.True : style.False}
                    >
                        <input type="hidden" name="isVegan" value={isVegan.toString()} />
                        <img src="/public/images/vegan.png" alt="vegan" />
                    </button>
                    <button
                        type="button"
                        onClick={() => toggleDietary(setIsVegetarian, isVegetarian)}
                        className={isVegetarian ? style.True : style.False}
                    >
                        <input type="hidden" name="isVegetarian" value={isVegetarian.toString()} />
                        <img src="/public/images/vegetarian.png" alt="vegetarian" />
                    </button>
                    <button
                        type="button"
                        onClick={() => toggleDietary(setIsLactoseFree, isLactoseFree)}
                        className={isLactoseFree ? style.True : style.False}
                    >
                        <input type="hidden" name="isLactoseFree" value={isLactoseFree.toString()} />
                        <img src="/public/images/lactose.png" alt="lactose-free" />
                    </button>
                    <button
                        type="button"
                        onClick={() => toggleDietary(setIsGlutenFree, isGlutenFree)}
                        className={isGlutenFree ? style.True : style.False}
                    >
                        <input type="hidden" name="isGlutenFree" value={isGlutenFree.toString()} />
                        <img src="/public/images/gluten.png" alt="gluten-free" />
                    </button>
                </div>
                <input type="submit" value="Zapisz" />
            </form>
        </section>
    );
};

export default AddProduct;
