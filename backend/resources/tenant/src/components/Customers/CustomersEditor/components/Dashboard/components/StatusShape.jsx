import React from "react";
import { useSelector } from "react-redux";

function StatusShape({ text }) {
    const GlobalColor = useSelector((state) => state.button.GlobalColor);
    const GlobalShape = useSelector((state) => state.button.GlobalShape);

    return (
        <div className="w-[100%]">
            <div className="flex items-center justify-center text-center w-fit text-[var(--primary)]">
                {text === "Completed" && (
                    <div
                        className="text-[var(--primary)] bg-[var(--secondary)] py-1 px-3"
                        style={{
                            borderRadius: GlobalShape,
                        }}
                    >
                        {text}
                    </div>
                )}
                {text === "Refunded" && (
                    <div
                        className="text-[#AF2519] bg-[#AF251915] py-1 px-3"
                        style={{
                            borderRadius: GlobalShape,
                        }}
                    >
                        {text}
                    </div>
                )}
                {text === "Cancelled" && (
                    <div
                        className="text-[#193AAF] bg-[#193AAF15] py-1 px-3"
                        style={{
                            borderRadius: GlobalShape,
                        }}
                    >
                        {text}
                    </div>
                )}
                {text !== "Completed" ? (
                    text !== "Refunded" ? (
                        text !== "Cancelled" ? (
                            <div
                                className="text-[var(--primary)] bg-[var(--secondary)] py-1 px-3"
                                style={{
                                    borderRadius: GlobalShape,
                                }}
                            >
                                {text}
                            </div>
                        ) : (
                            <div></div>
                        )
                    ) : (
                        <div></div>
                    )
                ) : (
                    <div></div>
                )}
            </div>
        </div>
    );
}

export default StatusShape;
