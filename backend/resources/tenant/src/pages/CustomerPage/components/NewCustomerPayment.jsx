import React, { useState } from "react";
import { useTranslation } from "react-i18next";
import AddCard from "./AddCard";
import imgPayment from "../../../assets/cardProfileIcon.svg";
import CardPayment from "./NewCardPayment";
import imgMasterCard from "../../../assets/mastercard.svg";
import imgVisa from "../../../assets/visa.svg";

const CustomerPayment = () => {
  const { t } = useTranslation();

  const [cards, setCards] = useState([]);
  const [addMode, setAddMode] = useState(false);

  return (
    <>
      {!addMode ? (
        <div className="m-12 mb-5 h-full">
          <div className="flex flex-row justify-between mb-5">
            <div className="flex items-center gap-3">
              <img src={imgPayment} alt="cards" className="w-8" />
              <h3 className="text-3xl font-medium">{t("Cards")}</h3>
            </div>
            {cards?.length !== 0 && (
              <div
                className="text-center cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 w-32 transition-all"
                onClick={() => setAddMode(true)}
              >
                {t("Add card")}
              </div>
            )}
          </div>
          <div className="flex flex-wrap gap-4 mb-5 mx-3 min-h-96">
            {cards?.map((card, index) => (
              <>
                <div className="w-max" key={index}>
                  <CardPayment
                    poweredByImgURl={
                      card?.brand === "VISA"
                        ? imgVisa
                        : card?.brand === "MASTERCARD"
                        ? imgMasterCard
                        : ""
                    }
                    cardType={
                      card?.funding === "CREDIT"
                        ? "Platinum Credit"
                        : "Platinum Debit"
                    }
                    CardNumber={`${card?.first_six}**  ****  ${card?.last_four}`}
                    ValidThruNo={`${card?.expiry?.month}/${card?.expiry?.year}`}
                  />
                </div>
                {/* <CardItem key={index} card={card} setViewOnMap={() => {}} /> */}
              </>
            ))}
            {cards?.length === 0 && (
              <div className="place-self-center text-center items-center w-full flex flex-col gap-4">
                <div className="text-2xl">{t("You don't have any cards")}</div>
                <div>{t("Please add one or more cards.")}</div>
                <div
                  className="cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 w-32 transition-all shadow-md"
                  onClick={() => setAddMode(true)}
                >
                  {t("Add card")}
                </div>
              </div>
            )}
          </div>
        </div>
      ) : (
        <AddCard
          onAdd={(card) => {
            setAddMode(false);
            setCards([...cards, card]);
          }}
          onCancel={() => {
            setAddMode(false);
          }}
        />
      )}
    </>
  );
};

export default CustomerPayment;
