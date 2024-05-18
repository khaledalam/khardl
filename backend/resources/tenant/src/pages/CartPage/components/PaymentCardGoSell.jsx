import React, { useState, useEffect } from "react";
import { GoSellElements } from "@tap-payments/gosell";

const PaymentCardGoSell = ({ callBackWithToken }) => {
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const initializePayment = async () => {
      try {
        await new Promise((resolve) => setTimeout(resolve, 2000));
        setIsLoading(false);
      } catch (err) {
        setError("Failed to initialize payment gateway.");
        setIsLoading(false);
      }
    };

    initializePayment();
  }, []);

  if (isLoading) {
    return (
      <div className="w-screen h-screen flex items-center justify-center">
        <span className="loading loading-spinner text-primary"></span>
      </div>
    );
  }

  if (error) {
    return <div>Error: {error}</div>;
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
