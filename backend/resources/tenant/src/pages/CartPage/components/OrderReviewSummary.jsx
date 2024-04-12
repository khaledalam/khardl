import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";
import parseOptionItems from "./Utils";

export default function OrderReviewSummary({ cart }) {
    const { t } = useTranslation();
    const language = useSelector((state) => state.languageMode.languageMode);

    const parseCartItems = () => {
        const summary = cart?.items.map((product, index) => {
            let extra = 0;
            const productName = product.item.name.ar;
            const productCount = product.quantity;
            const productPrice = productCount * product.price;

            // [ Category, Option Name, Price ]
            let optionsItems = parseOptionItems(product, true);

            const jsxOption = optionsItems.map((option) => {
                const optionName = `${option[0]} - ${option[1]}`;
                const optionPrice = option[2];

                extra += Number(optionPrice);
                return (
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
                                {`${productCount}x `}
                                <span className="text-lg text-black">
                                    {productName}
                                </span>
                            </p>
                        </h3>
                        <span>
                            {productPrice} {t("SAR")}
                        </span>
                    </div>
                    {optionsItems.length > 0 && <div className="flex justify-between mt-3">
                        <span>{t("Extras")}</span>
                        <span>
                            {extra} {t("SAR")}
                        </span>
                    </div>}
                    <div>{jsxOption}</div>
                </div>
            );
        });

        return summary;
    };

    return (
        <>
            <h2>{t("Review Order Details")}</h2>
            {parseCartItems()}
        </>
    );
}
