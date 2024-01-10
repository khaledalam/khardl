import React from "react"
import CardPayment from "./CardPayment"
import imgPayment from "../../../assets/cardProfileIcon.svg"
import imgVisa from "../../../assets/visa.svg"
import imgMasterCard from "../../../assets/mastercard.svg"
import {useTranslation} from "react-i18next"

const CustomerPayment = () => {
  const {t} = useTranslation()
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
        <div className='w-max'>
          <CardPayment
            poweredByImgURl={imgVisa}
            CardNumber={"5214  32**  ****  1673"}
            ValidThruNo={"11/27"}
          />
        </div>
        <div className='w-max'>
          <CardPayment
            poweredByImgURl={imgMasterCard}
            CardNumber={"5214  32**  ****  1673"}
            ValidThruNo={"11/27"}
          />
        </div>
        <div className='w-max'>
          <CardPayment
            poweredByImgURl={imgVisa}
            CardNumber={"5214  32**  ****  1673"}
            ValidThruNo={"11/27"}
          />
        </div>
        <div className='w-max'>
          <CardPayment
            poweredByImgURl={imgMasterCard}
            CardNumber={"5214  32**  ****  1673"}
            ValidThruNo={"11/27"}
          />
        </div>
      </div>
    </div>
  )
}

export default CustomerPayment
