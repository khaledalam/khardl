import React from "react";
import Eyes from "./Eyes";
import { useTranslation } from "react-i18next";

const OrderDetailsTable = ({ data = [], language }) => {
    const { t } = useTranslation();
    const getCheckbox = (id) => {
        const checkbox_options_names =
            data && data.length > 0 && data[id]?.checkbox_options !== null
                ? data[id]?.checkbox_options
                      .map((option, key) => {
                          const namesArray =
                              language === "en"
                                  ? Object.values(option?.en)
                                  : Object.values(option?.ar);
                          return namesArray;
                      })[0][0]
                      .map((option, idx) => option)
                : [];
        return checkbox_options_names;
    };

    const getSelectionNames = (id) => {
        const selection_options_names =
            data && data.length > 0 && data[id]?.selection_options !== null
                ? data[id]?.selection_options
                      .map((option, key) => {
                          const namesArray =
                              language === "en"
                                  ? Object.values(option?.en)
                                  : Object.values(option?.ar);
                          return namesArray;
                      })[0]
                      .map((option, idx) => ({ name: option[0] }))
                : [];

        return selection_options_names;
    };

    return (
        <div className="w-full">
            <table className="w-full table">
                <thead className="w-full ">
                    <tr className="text-black h-[60px]">
                        <th className="font-bold text-[1rem]">{t('Product')}</th>
                        <th className="font-bold text-[1rem]">{t('Name')}</th>
                        <th className="font-bold text-[1rem]">{t('Quantity')}</th>
                        <th className="font-bold text-[1rem]">{t('additional')}</th>
                        <th className="font-bold text-[1rem]">{t('price')}</th>
                        <th className="font-bold text-[1rem]">{t('Notes')}</th>
                    </tr>
                </thead>
                <tbody>
                    {data &&
                        data?.map((order, idx) => (
                            <tr
                                key={idx}
                                className="h-[80px] bg-white my-4  cursor-pointer"
                            >
                                <td>
                                    <h3 className="text-sm font-medium">
                                        {idx + 1}
                                    </h3>
                                </td>
                                <td className="h-full">{order?.item?.name}</td>
                                <td>
                                    <h3 className="">{order?.quantity}</h3>
                                </td>
                                <td>
                                    {/* <ul className='list-disc'>
                    {idx &&
                      getCheckbox(idx) &&
                      getCheckbox(idx).length > 0 &&
                      getCheckbox(idx)?.map((item) => (
                        <li className=''>{item[0]}</li>
                      ))}
                    {idx &&
                      getSelectionNames(idx) &&
                      getSelectionNames(idx).length > 0 &&
                      getSelectionNames(idx)?.map((item) => (
                        <li className=''>{item.name}</li>
                      ))}
                  </ul> */}
                                    <h3 className=""></h3>
                                </td>
                                <td>
                                    <h3 className="">
                                        {t("SAR")}{" "}
                                        {order?.price + order?.options_price}
                                    </h3>
                                </td>
                                <td>
                                    <h3 className="">{order?.notes}</h3>
                                </td>
                            </tr>
                        ))}
                </tbody>
            </table>
        </div>
    );
};

export default OrderDetailsTable;
