import React, { useState } from "react";
import { useTranslation } from "react-i18next";
import PrimaryTextInput from "./PrimaryTextInput";
import imgPayment from "../../../assets/cardProfileIcon.svg";
import imgMasterCard from "../../../assets/mastercard.svg";
import imgVisa from "../../../assets/visa.svg";

export const CardTypeIcons = { VISA: imgVisa, MASTERCARD: imgMasterCard };

const AddCard = ({ onAdd, onCancel }) => {
  const { t } = useTranslation();
  const [card, setCard] = useState({
    cardType: "VISA",
    name: "",
    cardNumber: "",
    expiry: "",
    CVC: "",
    funding: "CREDIT",
  });

  return (
    <div className="m-4 mt-8 md:m-12 mb-5">
      <div className="flex items-center gap-3">
        <img src={imgPayment} alt="cards" className="w-8" />
        <h3 className="text-3xl font-medium">{t("Add new card")}</h3>
      </div>
      <div className="flex flex-wrap flex-row gap-4 mb-5 mx-3 min-h-96 font-['Plus Jakarta Sans'] items-center h-full justify-center mt-8">
        <div className="flex-col justify-center items-start gap-4 inline-flex h-full w-[450px]">
          <div className="self-stretch justify-between items-center inline-flex">
            <div className="text-black text-opacity-75 font-medium text-sm ">
              {t("Select card type")}
            </div>
            <div className="justify-center items-start gap-2 flex">
              {Object.getOwnPropertyNames(CardTypeIcons).map(
                (cardType, index) => (
                  <div
                    className={`transition-all px-[9px] py-2 rounded-sm border justify-start items-center gap-2 flex font-light cursor-pointer text-xs bg-white ${
                      cardType === card.cardType
                        ? "border-neutral-900 text-black"
                        : "border-gray-200 text-zinc-600"
                    }`}
                    key={index}
                    onClick={() =>
                      setCard((prevCard) => ({
                        ...prevCard,
                        cardType,
                      }))
                    }
                  >
                    <img
                      className="w-[46px] h-8 rounded-md border border-gray-100 bg-gray-400"
                      src={CardTypeIcons[cardType]}
                      alt={cardType}
                    />
                  </div>
                )
              )}
            </div>
          </div>
          <div className="self-stretch h-fit flex-col justify-start items-center gap-4 flex flex-wrap">
            <PrimaryTextInput
              placeholder={t("Write the name shown on the card...")}
              value={card.name}
              onChange={(value) =>
                setCard((prevCard) => ({
                  ...prevCard,
                  name: value,
                }))
              }
              id="name"
              label={t("Name on card")}
            />
            <PrimaryTextInput
              placeholder={t("Write your credit card number here...")}
              value={card.cardNumber}
              onChange={(value) =>
                setCard((prevCard) => ({
                  ...prevCard,
                  cardNumber: value,
                }))
              }
              id="cardNumber"
              label={t("Card number")}
            />
            <div className="flex flex-row gap-4 flex-wrap md:flex-nowrap">
              <div className="w-full md:w-1/2">
                <PrimaryTextInput
                  placeholder={t("mm / yy")}
                  value={card.card}
                  onChange={(value) =>
                    setCard((prevCard) => ({
                      ...prevCard,
                      expiry: value,
                    }))
                  }
                  id="expiryDate"
                  label={t("Expiry date")}
                />
              </div>
              <div className="w-full md:w-1/2">
                <PrimaryTextInput
                  placeholder={t("Write your CVC code here...")}
                  value={card.card}
                  onChange={(value) =>
                    setCard((prevCard) => ({
                      ...prevCard,
                      CVC: value,
                    }))
                  }
                  id="CVC"
                  label={t("CVC")}
                />
              </div>
            </div>
          </div>
          <div className="self-stretch h-fit flex-col justify-start items-center gap-4 flex text-center">
            <div
              className="w-full cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 transition-all shadow-md"
              onClick={() => onAdd(card)}
            >
              {t("Save card")}
            </div>
            <div
              className="w-full cursor-pointer text-white bg-gray-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-gray-900 hover:text-gray-900 transition-all shadow-md"
              onClick={() => {
                setCard({
                  cardType: "VISA",
                  name: "",
                  phoneNumber: "",
                  card: "",
                  CVC: "",
                  funding: "CREDIT",
                });
                onCancel();
              }}
            >
              {t("Cancel")}
            </div>
          </div>
        </div>
        {/* <div className="grow shrink basis-0 self-stretch p-4 rounded-[10px] border border-black border-opacity-20 flex-col justify-start items-center gap-2.5 inline-flex h-full">
          <img src="" alt="" className="" />
        </div> */}
      </div>
    </div>
  );
};

export default AddCard;
