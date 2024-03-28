import { GoSellElements } from "@tap-payments/gosell";

const PaymentCardGoSell = ({ callBackWithToken }) => {
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
