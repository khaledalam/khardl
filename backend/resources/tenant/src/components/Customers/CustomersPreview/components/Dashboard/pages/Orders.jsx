import React, {useEffect} from 'react';
import { useTranslation } from 'react-i18next';
import FullOrders from '../components/Orders';
import { useSelector } from 'react-redux';
import AxiosInstance from "../../../../../../axios/axios";

const Orders = () => {
   const { t } = useTranslation();
   const Language = useSelector((state) => state.languageMode.languageMode);
   const orderShow = useSelector((state) => state.order.orderShow);
   const idOrder = useSelector((state) => state.id.idOrder);
   const activeTab = useSelector((state) => state.tab.activeTab);
   const GlobalColor = useSelector((state) => state.button.GlobalColor);

   return (
      <div className="w-full bg-[var(--secondary)] py-6 px-4">
         {(activeTab === "Orders" && orderShow === true) ?
            <p className='mb-6 font-bold'
            style={{ color: GlobalColor }}
           >{t("Order Details")}</p>
            :
            <p className='mb-6 font-bold'>{t("Orders")}</p>
         }
         <div className="p-8 bg-white">
            <div className='w-full bg-white text-center' id="id">
               <FullOrders />
            </div>
         </div>
      </div>
   )
}

export default Orders;
