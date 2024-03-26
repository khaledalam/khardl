import { useTranslation } from "react-i18next";
import CartDetailSection from "./CartDetailSection";
import Places from "../../../components/Customers/CustomersEditor/components/Dashboard//components/Places";

const CartAddress = ({
    userAddress,
    isChecked,
    onChange,
    selectedDeliveryAddress,
}) => {
    const { t } = useTranslation();

    return (
        <div className="addressSection">
            <h2>{t("Address")}</h2>
            {userAddress?.addressValue && (
                <CartDetailSection
                    name={userAddress?.addressValue}
                    onChange={() => onChange(0)}
                    isChecked={selectedDeliveryAddress === 0}
                    displayName={userAddress?.addressValue}
                />
            )}
            <CartDetailSection
                name="customAddress"
                onChange={() => onChange(1)}
                isChecked={selectedDeliveryAddress === 1}
                displayName={t("Custom Address")}
            />

            {selectedDeliveryAddress === 1 && (
                <div className="w-full mt-2 map">
                    <Places />
                </div>
            )}
        </div>
    );
};

export default CartAddress;
