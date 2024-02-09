import React from "react"
import CardPayment from "./CardPayment"
import imgPayment from "../../../assets/cardProfileIcon.svg"
import imgVisa from "../../../assets/visa.svg"
import imgMasterCard from "../../../assets/mastercard.svg"
import {useTranslation} from "react-i18next"

const CustomerPayment = ({cardsList}) => {
  const {t} = useTranslation()

  /*
  
  */

  console.log({cardsList})
  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={imgPayment} alt='Payment' className='' />
        <h3 className='text-xl font-medium'>{t("Payment")}</h3>
      </div>
      <h3 className='border-b inline-block border-[var(--customer)] text-xl pb-1 my-5'>
        {t("My Card")}
      </h3>
      <div className='w-auto overflow-x-scroll h-full flex items-center gap-14 my-5 hide-scroll'>
        {cardsList && cardsList.length > 0 ? (
          cardsList.map((card) => (
            <div className='w-max' key={card.id}>
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
          ))
        ) : (
          <div className='h-full w-full flex items-center justify-center'>
            <h3 className='text-xl '>{t('You have no saved card at the moment')}</h3>
          </div>
        )}
      </div>
    </div>
  )
}

export default CustomerPayment
