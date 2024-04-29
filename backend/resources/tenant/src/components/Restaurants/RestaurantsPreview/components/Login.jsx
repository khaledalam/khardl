import React, { useRef } from "react";
import { motion } from "framer-motion";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";
import { toast } from "react-toastify";

const DetailesItem = ({ onClose }) => {
  const GlobalShape = sessionStorage.getItem("globalShape");
  const GlobalColor = sessionStorage.getItem("globalColor");
  const { branches } = useSelector(
    (state) => state.styleDataRestaurant.styleDataRestaurant,
  );
  const Language = useSelector((state) => state.languageMode.languageMode);

  const branchesSelectRef = useRef(null);

  const { t } = useTranslation();

  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);

  if (!branches) {
    return;
  }

  let selectedBranch = branches.filter(
    (b) => b?.id == localStorage.getItem("selected_branch_id"),
  );
  if (selectedBranch.length > 0) {
    selectedBranch = selectedBranch[0];
  }
  console.log("selectedBranch", selectedBranch);

  //
  // if (!selectedBranch?.name) {
  //     toast.error("No default branch selected");
  //     return;
  // }

  const saveDefaultBranchLocal = () => {
    if (!branchesSelectRef.current?.value) {
      toast.error("Invalid selected branch!");
      return;
    }

    localStorage.setItem(
      "selected_branch_id",
      branchesSelectRef.current?.value,
    );

    toast.info(
      "Default branch changed to " +
        branchesSelectRef.current.options[
          branchesSelectRef.current.selectedIndex
        ]?.text +
        " successfully",
    );
    setTimeout(() => {
      window.location.reload();
    }, 500);
  };

  return (
    <>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        className="font-general-medium fixed inset-0 z-[99] transition-all duration-500"
      >
        <button
          onClick={onClose}
          className="w-full h-full fixed inset-0 z-30 transition-all duration-500"
        />
        <div className="bg-[#000000]  bg-opacity-50 fixed inset-0 w-full h-full z-20" />
        <main className="flex flex-col items-center justify-center h-full w-full">
          <div className="modal-wrapper flex items-center z-[50]">
            <div className="modal max-w-md min-w-[480px] bg-white overflow-y-auto mx-5 xl:max-w-xl lg:max-w-xl md:max-w-xl max-h-screen shadow-lg flex-row rounded-lg ">
              <div className="modal-header grid grid-cols-1 p-5 items-center border-b border-ternary-light">
                <div className="text-center">
                  <h5 className="text-center text-black font-bold text-lg">
                    {t("Your default branch")}
                  </h5>
                  {selectedBranch?.name ? (
                    <pre
                      className={"border my-2 text-left p-2"}
                      style={{
                        direction: Language == "en" ? "ltr " : "rtl",
                        textAlign: Language == "en" ? "left " : "right",
                      }}
                    >
                      {t("Name")}: {selectedBranch?.name}
                      <br />
                      {t("Delivery Availability")}:{" "}
                      {t(selectedBranch?.delivery_availability ? "Yes" : "No")}
                      <br />
                      {t("Pickup Availability")}:{" "}
                      {t(selectedBranch?.pickup_availability ? "Yes" : "No")}
                      <br />
                      {t("Preparation time delivery")}:{" "}
                      {selectedBranch?.preparation_time_delivery ||
                        t("not set")}
                    </pre>
                  ) : (
                    <span className={""}>
                      {t("No default branch selected")}
                    </span>
                  )}
                </div>

                <hr className={"my-5"} />

                <h5 className="text-center text-black font-bold text-lg">
                  {t("Change Default Branch")}
                </h5>
                <select
                  defaultValue={selectedBranch?.id}
                  ref={branchesSelectRef}
                  className="text-[14px] bg-[var(--primary)] w-[100%] p-1 rounded-full px-4 appearance-none"
                >
                  {/*<option value={null}/>*/}
                  {branches?.map((b, idx) => {
                    return (
                      <option key={idx} value={b?.id}>
                        {b?.name}
                      </option>
                    );
                  })}
                </select>

                <div className="relative py-4 px-8 w-[100%]">
                  {/*<Maps />*/}
                </div>

                <div className="flex justify-center items-center">
                  <button
                    onClick={(e) => saveDefaultBranchLocal()}
                    className="text-center font-bold text-lg p-1 px-4 mt-6 mb-2"
                    style={{
                      backgroundColor: "var(--primary)",
                      borderRadius: GlobalShape,
                    }}
                  >
                    {t("Save")}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </main>
      </motion.div>
    </>
  );
};
export default DetailesItem;
