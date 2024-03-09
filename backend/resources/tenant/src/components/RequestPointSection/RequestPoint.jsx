import React from "react";
import RequestPointSection from "../../assets/RequestPointSection.webp";
import request from "../../assets/request.webp";
import { useTranslation } from "react-i18next";
import Button from "../../components/Button";
import TextWithLine from "../../components/TextWithLine";

function RequestPoint() {
    const { t } = useTranslation();

    return (
        <section
            className="mx-[160px] max-[1250px]:mx-[20px]"
            data-aos="zoom-in"
            data-aos-delay="800"
        >
            <div
                className="w-[100%] h-[100%]"
                style={{
                    backgroundImage: `url(${RequestPointSection})`,
                    backgroundSize: "cover",
                }}
            >
                <div className="grid grid-cols-2 items-center max-[700px]:flex  max-[700px]:flex-wrap-reverse">
                    <div className="mb-4 uppercase">
                        <img
                            className="w-[80%] max-[1200px]:w-[100%] h-[100%]"
                            src={request}
                            alt="logo"
                        />
                    </div>
                    <div className="flex flex-col items-center justify-center gap-6">
                        <TextWithLine
                            text={t("Each point for an order")}
                            classNameLine="!w-[75px]"
                        />
                        <h2 className="max-w-[500px] text-center mb-4">
                            {t("Each point for an order details")}
                        </h2>
                        <Button
                            title={t("Start Now")}
                            link="/register"
                            classContainer={`!border-none !px-[70px] !py-3`}
                        />
                    </div>
                </div>
            </div>
        </section>
    );
}

export default RequestPoint;
