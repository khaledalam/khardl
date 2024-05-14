import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";
import parseOptionItems from "./Utils";

export default function OrderReviewSummary({ items }) {
  const { t } = useTranslation();
  const language = useSelector((state) => state.languageMode.languageMode);

  return (
    <>
      <h2>{t("Review Order Details")}</h2>
      {items.map((product, index) => {
        let extra = 0;

        // [ Category, Option Name, Price ]
        let optionsItems = parseOptionItems(product, true);

        const jsxOption = [];
        optionsItems.map((option) => {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
          const optionName = `${option[0]} - ${option[1]}`;
          const optionPrice = option[2];

          extra += Number(optionPrice);
          jsxOption.push(
            <div key={index} className="flex justify-between mt-3">
              <span>{optionName}</span>
              <span>
                {optionPrice} {t("SAR")}
              </span>
            </div>
          );
        });

        return (
          <div key={index} className="mt-3">
            <div className="flex justify-between">
              <h3 className="gap-5">
                <p className="text-sm text-gray-500	">
                  {`${product.quantity}x `}
                  <span className="text-lg text-black">{product.item.name.ar}</span>
                </p>
              </h3>
              <span>
                {product.quantity * product.price} {t("SAR")}
              </span>
            </div>
            {optionsItems.length > 0 && (
              <div className="flex justify-between mt-3">
                <span>{t("Extras")}</span>
                <span>
                  {extra} {t("SAR")}
                </span>
              </div>
            )}
            <div>{jsxOption}</div>
          </div>
        );
      })}
    </>
  );
}
