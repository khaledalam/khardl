import React, { useState, useEffect, useRef } from 'react';
import { useSelector } from 'react-redux';
import { useTranslation } from "react-i18next";
import AxiosInstance from "../../axios/axios";
import Footer from "../Footer/Footer";
import './Cart.css'


const Cart = () => {

    const [cartItems, setCartItems] = useState([]);
    const { t } = useTranslation();


    useEffect(() => {
        fetchCartData().then(r => null);
    }, []);


    const fetchCartData = async () => {
        try {
            const cartResponse = await AxiosInstance.get(`carts`);

            console.log("cart >>>", cartResponse.data)
            if (cartResponse.data) {
                setCartItems(cartResponse.data?.data);
            }

        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };

    const getTotalPrice = () => {
        return cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
    };

    const handleRemoveItem = (itemId) => {
        const updatedCart = cartItems.filter(item => item.id !== itemId);
        setCartItems(updatedCart);
    };

    const handleQuantityChange = (itemId, newQuantity) => {
        const updatedCart = cartItems.map(item =>
            item.id === itemId ? { ...item, quantity: newQuantity } : item
        );
        setCartItems(updatedCart);
    };

    return (
        <div className="cart-page">
            <div className={"cart-content"}>
                {cartItems.length === 0 ? (
                    <p className={"text-center "}>{t('Your cart is empty')}</p>
                ) : (
                    <div>
                        <ul className="cart-items">
                            {cartItems.map(item => (
                                <li key={item.id}>
                                    <span>{item.name}</span>
                                    <span>${item.price}</span>
                                    <span>
                      <label htmlFor={`quantity-${item.id}`}>Quantity:</label>
                      <input
                          id={`quantity-${item.id}`}
                          type="number"
                          min="1"
                          value={item.quantity}
                          onChange={(e) => handleQuantityChange(item.id, parseInt(e.target.value))}
                      />
                    </span>
                                    <span>Total: ${item.price * item.quantity}</span>
                                    <button onClick={() => handleRemoveItem(item.id)}>Remove</button>
                                </li>
                            ))}
                        </ul>
                        <div className="cart-summary">
                            <h3>Total: ${getTotalPrice()}</h3>
                            <button>Checkout</button>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );

  const divWidth = useSelector((state) => state.divWidth.value);
  const divRef = useRef(null);
    const selectedFontFamily = useSelector((state) => state.fonts.selectedFontFamily);
    const selectedFontWeight = useSelector((state) => state.fonts.selectedFontWeight);
    const selectedAlignText = useSelector((state) => state.alignText?.selectedAlignText);

    const [cart, setCart] = useState([]);



  return (
    <div ref={divRef} className="w-[100%] bg-white h-[85vh] overflow-y-auto" style={{ fontFamily: `${selectedFontFamily}`, fontWeight: `${selectedFontWeight}`,fontSize:`${selectedFontFamily}` }}>
      <div className={`mt-[30px] mb-[50px] ${divWidth >= 744 ? "mx-[40px]" : ""}`}>
        <div>
          <div>
            <div className={`px-[30px] text-xl`}>
                {cart?.length > 0 ?
                    <>
                        <h2>Cart Items:</h2>
                    </>
                    : <h2>No Items in cart yet!</h2>}
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default Cart;
