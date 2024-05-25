import React, { useState, useEffect } from "react";
import { GoSellElements } from "@tap-payments/gosell";
import { useSelector } from "react-redux";
import ClipLoader from "react-spinners/ClipLoader";

const PaymentCardGoSell = ({ callBackWithToken, setLoading }) => {
  const [isLoading, setIsLoading] = useState(true);
  const restaurantStyle = useSelector((state) => {
    return state.restuarantEditorStyle;
  });

  useEffect(() => {
    const initializePayment = async () => {
      try {
        await new Promise((resolve) => setTimeout(resolve, 500));
        setIsLoading(false);
      } catch (err) {
        setIsLoading(false);
      }
    };

    initializePayment();
  }, []);

  if (isLoading) {
    return (
      <div className={"m-auto w-28 mt-2"}>
        <ClipLoader
          color={restaurantStyle?.page_color}
          loading={isLoading}
          size={100}
        />
      </div>
    );
  }

  return (
    <div>
      <GoSellElements
        gateway={{
          publicKey: "pk_test_Zzq7mShJgR49inPEblsICXay",
          language: "ar",
          supportedCurrencies: "all",
          supportedPaymentMethods: "all",
          callback: callBackWithToken,
          notifications: "standard",
          labels: {
            cardNumber: "Card Number",
            expirationDate: "MM/YY",
            cvv: "CVV",
            cardHolder: "Name on Card",
            actionButton: "Pay",
          },
          style: {
            base: {
              color: "#535353",
              lineHeight: "18px",
              fontSize: "16px",
              "::placeholder": {
                color: "rgba(0, 0, 0, 0.26)",
                fontSize: "15px",
              },
            },
            invalid: {
              color: "red",
              iconColor: "#fa755a ",
            },
          },
        }}
      />
    </div>
  );
};

export default PaymentCardGoSell;
