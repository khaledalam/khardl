import { useSelector } from "react-redux";
import { useTranslation } from "react-i18next";

const parseOptionItems = (cartitem, returnArray = false) => {
  const language = useSelector((state) => state.languageMode.languageMode);
  const { t } = useTranslation();

  // [ Category, Option Name, Price ]

  let $optionListString = [];
  let $optionArray = [];

  if (cartitem.dropdown_options) {
    cartitem.dropdown_options.forEach(($option, $masterIdx) => {
      let $optionPair = $option[language];
      let $optionKey = Object.keys($optionPair)[0];
      let $optionValue = $optionPair[$optionKey];

      let $prices = cartitem?.item?.dropdown_input_prices?.[$masterIdx] ?? [];
      let $optionPrice = "";

      // Get price of item option
      let $names = cartitem?.item?.dropdown_input_names[$masterIdx];
      for (let $indexTarget = 0; $indexTarget < $names.length; $indexTarget++) {
        if ($names[$indexTarget]?.indexOf($optionValue) > -1) {
          $optionPrice = $prices[$indexTarget];
          break;
        }
      }
      $optionListString.push(
        `${$optionKey}: ${$optionValue}, ${$optionPrice} ${t("SAR")}`,
      );
      $optionArray.push([$optionKey, $optionValue, $optionPrice]);
    });
  }

  if (cartitem.selection_options) {
    cartitem.selection_options.forEach(($option) => {
      let $optionPair = $option[language];
      let $optionKey = Object.keys($optionPair)[0];
      let $optionValue = $optionPair[$optionKey][0];
      let $optionPrice = $optionPair[$optionKey][1];
      $optionListString.push(
        `${$optionKey}: ${$optionValue},  ${$optionPrice} ${t("SAR")}`,
      );
      $optionArray.push([$optionKey, $optionValue, $optionPrice]);
    });
  }

  if (cartitem.checkbox_options) {
    cartitem.checkbox_options.forEach(($option) => {
      let $optionPair = $option[language];
      let $optionKey = Object.keys($optionPair)[0];
      let $optionValues = $optionPair[$optionKey] ?? [];

      let $optionResult = `${$optionKey}: `;
      $optionValues.forEach(($pair, $idx) => {
        let $optionValueName = $pair[0];
        let $optionValuePrice = $pair[1];
        $optionListString.push(
          `${$optionKey}: ${$optionValueName},  ${$optionValuePrice} ${t("SAR")}`,
        );
        $optionArray.push([$optionKey, $optionValueName, $optionValuePrice]);
      });
    });
  }

  return returnArray ? $optionArray : $optionListString;
};

export default parseOptionItems;
