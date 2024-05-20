import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import AddCard, { CardTypeIcons } from "./AddCard";
import imgPayment from "../../../assets/cardProfileIcon.svg";
import CardPayment from "./NewCardPayment";
import imgMasterCard from "../../../assets/mastercard.svg";
import imgVisa from "../../../assets/visa.svg";
import { useDispatch, useSelector } from "react-redux";
import { updateCardsList } from "../../../redux/NewEditor/customerSlice";

const CustomerPayment = () => {
  const { t } = useTranslation();
  const cards = useSelector((state) => state.customerAPI.cardsList);
  const dispatch = useDispatch();

  const [addMode, setAddMode] = useState(false);

  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );

  const { price_background_color } = restuarantEditorStyle;

  const setCards = (cards) => {
    dispatch(updateCardsList(cards));
  };

  const fetchCardsData = async () => {
    try {
      const cardsResponse = await AxiosInstance.get(`cards`);

      if (cardsResponse.data && Array.isArray(cardsResponse?.data?.data)) {
        dispatch(updateCardsList(Object.values(cardsResponse?.data?.data)));
      }
    } catch (error) {
      console.log(error);
    } finally {
    }
  };

  useEffect(() => {
    fetchCardsData().then(() => {});
  }, []);

  return (
    <>
      {!addMode ? (
        <div className="m-4 mt-8 md:m-12 mb-5 h-full">
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
                    poweredByImgURl={CardTypeIcons[card.cardType]}
                    cardType={
                      card?.funding === "CREDIT"
                        ? "Platinum Credit"
                        : "Platinum Debit"
                    }
                    CardNumber={`${card?.cardNumber.slice(
                      0,
                      6
                    )}**  ****  ${card?.cardNumber.slice(
                      card?.cardNumber.length - 6
                    )}`}
                    ValidThruNo={card?.expiry}
                    onDelete={() =>
                      dispatch(
                        updateCardsList(cards.filter((_, i) => i !== index))
                      )
                    }
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
                  className={`cursor-pointer text-white rounded-lg px-4 py-2.5 border hover:bg-white bg-[${price_background_color}] hover:border-[${price_background_color}] hover:text-[${price_background_color}] w-32 transition-all shadow-md`}
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
