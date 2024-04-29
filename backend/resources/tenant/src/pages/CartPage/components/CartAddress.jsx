import { useTranslation } from "react-i18next";
import CartDetailSection from "./CartDetailSection";
import Places from "../../../components/Customers/CustomersEditor/components/Dashboard//components/Places";

const CartAddress = ({
  user,
  isChecked,
  onChange,
  selectedDeliveryAddress,
}) => {
  const { t } = useTranslation();
  return (
    <div className="addressSection">
      <h2>{t("Address")}</h2>
      {user?.address?.addressValue && (
        <CartDetailSection
          name={user?.address?.addressValue}
          onChange={() => onChange(0)}
          isChecked={selectedDeliveryAddress === 0}
          displayName={user?.address?.addressValue}
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
          <Places isCart={true} user={user} />
        </div>
      )}
    </div>
  );
};

export default CartAddress;
