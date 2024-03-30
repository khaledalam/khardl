import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";

export default function OrderReviewSummary({ cart }) {
    const { t } = useTranslation();
    const language = useSelector((state) => state.languageMode.languageMode);

    const parseCartItems = () => {
        const summary = cart?.items.map((product, index) => {
            let extra = 0;
            const productName = product.item.name.ar;
            const productCount = product.quantity;
            const productPrice = productCount * product.price;

            const allOptions = [];

            if (product.dropdown_options) {
                allOptions.push(...product.dropdown_options);
            }

            if (product.selection_options) {
                allOptions.push(...product.selection_options);
            }

            const jsxOption = allOptions.map((option) => {
                let optionKey = Object.keys(option[language])[0];
                const optionName = `${optionKey} - ${option[language][optionKey]}`;
                const optionPrice = option.price;

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
                    <div className="flex justify-between mt-3">
                        <span>{t("extras")}</span>
                        <span>
                            {extra} {t("SAR")}
                        </span>
                    </div>
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
