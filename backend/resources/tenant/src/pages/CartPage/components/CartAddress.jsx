import { useTranslation } from "react-i18next";
import CartDetailSection from "./CartDetailSection";
import Places from "../../../components/Customers/CustomersEditor/components/Dashboard//components/Places";

const CartAddress = ({
  addresses = [],
  isChecked,
  onChange,
  selectedDeliveryAddress,
}) => {
  const { t } = useTranslation();
  return (
    <div className="addressSection">
      <h2>{t("Address")}</h2>
      {/* {user?.address?.addressValue && (
        <CartDetailSection
          name={user?.address?.addressValue}
          onChange={() => onChange(0)}
          isChecked={selectedDeliveryAddress === 0}
          // displayName={user?.address?.addressValue}
          displayName="Default"
        />
      )} */}
      {addresses?.map((addressItem, idx) => (
        <CartDetailSection
          name={addressItem.name}
          onChange={() => onChange(idx)}
          isChecked={selectedDeliveryAddress === idx}
          displayName={addressItem.name}
          title={addressItem.address}
        />
      ))}
      <CartDetailSection
        name="customAddress"
        onChange={() => onChange(addresses?.length)}
        isChecked={selectedDeliveryAddress === addresses?.length}
        displayName={t("Custom Address")}
      />

      {selectedDeliveryAddress === addresses?.length && (
        <div className="w-full mt-2 map">
          <Places isCart={true} />
        </div>
      )}
    </div>
  );
};

export default CartAddress;
