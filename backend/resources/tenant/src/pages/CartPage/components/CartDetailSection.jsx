import { RadioButton } from "primereact/radiobutton";
import { useTranslation } from "react-i18next";

const CartDetailSection = ({ name, onChange, isChecked, img, displayName }) => {
  const { t } = useTranslation();

  return (
    <div key={name} className="flex align-items-center mt-4">
      <RadioButton
        inputId={name}
        name={name}
        value={name}
        onChange={onChange}
        checked={isChecked}
        pt={{
          input: {
            className: "bg-black",
          },
        }}
      />
      <div htmlFor={name} className="flex mx-2">
        {img && (
          <img src={img} alt="" width={25} height={25} className="mx-2"></img>
        )}
        {t(displayName)}
      </div>
    </div>
  );
};

export default CartDetailSection;
