import React, { useEffect, useMemo, useState } from "react";
import { useTable, useGlobalFilter, useAsyncDebounce, useFilters, useSortBy, usePagination } from "react-table";
import { BsChevronLeft, BsChevronDoubleLeft, BsChevronRight, BsChevronDoubleRight } from "react-icons/bs";
import { Button, PageButton } from "./shared/Button";
import { SortDownIcon, SortUpIcon, SortIcon } from "./shared/Icon";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";
import { BiSearch } from "react-icons/bi";
import { IoIosArrowDown } from "react-icons/io";
import 'babel-polyfill'

function GlobalFilter({
    globalFilter,
    setGlobalFilter
}) {
    const Language = useSelector((state) => state.languageMode.languageMode);
    const GlobalShape = useSelector((state) => state.button.GlobalShape);
    const { t } = useTranslation();
    const [value, setValue] = useState(globalFilter);
    const onChange = useAsyncDebounce((value) => {
        setGlobalFilter(value || undefined);
    }, 200);

    return (
        <div className="relative w-[100%]">
            <div className={`text-gray-300 absolute inset-y-0 ${Language == 'en' ? 'right-0' : 'left-0'} flex items-center pe-3 pointer-events-none`}>
                <BiSearch />
            </div>
            <input
                type="search"
                id="default-search"
                value={value || ""}
                onChange={(e) => {
                    setValue(e.target.value);
                    onChange(e.target.value);
                }}
                style={{
                    borderRadius: GlobalShape
                }}
                className="text-[14px] bg-[var(--secondary)] w-[100%] p-2 px-4 appearance-none"
                placeholder={`${t("Search")}`}
            />
        </div>
    );
}

export function SelectColumnFilter({
    column: { filterValue, setFilter, preFilteredRows, id, render }
}) {
    const Language = useSelector((state) => state.languageMode.languageMode);
    const GlobalShape = useSelector((state) => state.button.GlobalShape);
    const options = useMemo(() => {
        const options = new Set();
        preFilteredRows.forEach((row) => {
            options.add(row.values[id]);
            console.log(row.values[id]);
        });
        return [...options.values()];
    }, [id, preFilteredRows]);
    const { t } = useTranslation();

    return (
        <label className={`flex justify-between gap-x-2 items-center relative w-[100%]`}>
            <div className={`text-gray-300 absolute inset-y-0 ${Language == 'en' ? 'right-0' : 'left-0'} flex items-center pe-3 pointer-events-none`}>
                <IoIosArrowDown />
            </div>
            <select
                className="text-[14px] bg-[var(--secondary)] min-w-[120px] p-2 px-4 appearance-none"
                name={id}
                id={id}
                value={filterValue}
                onChange={(e) => {
                    setFilter(e.target.value || undefined);
                }}
                style={{
                    borderRadius: GlobalShape
                }}
            >
                <option value="">{t(`${render("Header")}`)}</option>
                {options.map((option, i) => (
                    <option key={i} value={option}>
                        {option}
                    </option>
                ))}
            </select>
        </label>
    );
}

function Table({ columns, data }) {
    const {
        getTableProps,
        getTableBodyProps,
        headerGroups,
        prepareRow,
        page,
        canPreviousPage,
        canNextPage,
        pageOptions,
        pageCount,
        gotoPage,
        nextPage,
        previousPage,
        setPageSize,
        state,
        preGlobalFilteredRows,
        setGlobalFilter,
        globalFilter,
        preFilteredRows
    } = useTable(
        {
            columns,
            data
        },
        useFilters,
        useGlobalFilter,
        useSortBy,
        usePagination
    );
    const activeTab = useSelector((state) => state.tab.activeTab);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const GlobalColor = useSelector((state) => state.button.GlobalColor);
    const GlobalShape = useSelector((state) => state.button.GlobalShape);
    const divWidth = useSelector((state) => state.divWidth.value);

    const { t } = useTranslation();
    useEffect(() => {
        setPageSize(5);
    }, []);

    return (
        <>
            {activeTab === "Orders" &&
                <div>
                    <div className={`flex justify-between gap-3 ${divWidth <= 366 ? "flex-wrap !justify-start items-center gap-2" : ""}`}>
                        <GlobalFilter
                            preGlobalFilteredRows={preGlobalFilteredRows}
                            globalFilter={globalFilter}
                            setGlobalFilter={setGlobalFilter}
                        />
                        {
                            headerGroups.map((headerGroup) =>
                                headerGroup.headers.map((column) =>
                                    column.Filter ? (
                                        <div key={column.id} className="">{column.render("Filter")} </div>
                                    ) : null
                                )
                            )
                        }
                    </div>
                    <p className='font-bold flex items-center justify-start mt-6'>
                        <span>
                            {(preFilteredRows.length <= 10) ?
                                <span>{preFilteredRows.length} {t("orders")}</span>
                                :
                                <span>{preFilteredRows.length} {t("Order")}</span>
                            }
                        </span>
                    </p>
                </div>
            }
            <div className="mt-5 flex  flex-col overflow-hidden">
                <div className="-my-2 overflow-x-auto -mx-4 sm:-mx-6 lg:-mx-8">
                    <div className="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div
                            style={{
                                borderRadius: GlobalShape
                            }}
                            className="overflow-hidden border-b border-gray-200 !shadow-[0_0px_2px_var(--Forth)]">
                            <table
                                {...getTableProps()}
                                className="min-w-full divide-y divide-gray-200"
                            >
                                <thead className="bg-gray-50 ">
                                    {headerGroups.map((headerGroup) => (
                                        <tr className="py-4" {...headerGroup.getHeaderGroupProps()}>
                                            {headerGroup.headers.map((column) => (
                                                <th
                                                    scope="col"
                                                    className="group px-2 py-3 text-left text-[14px] font-bold text-black uppercase tracking-wider"
                                                    {...column.getHeaderProps(
                                                        column.getSortByToggleProps()
                                                    )}
                                                >
                                                    <div className="flex items-center justify-between gap-2">
                                                        {column.render("Header")}
                                                        <span>
                                                            {column.isSorted ? (
                                                                column.isSortedDesc ? (
                                                                    <SortDownIcon className="w-4 h-4 text-gray-400" />
                                                                ) : (
                                                                    <SortUpIcon className="w-4 h-4 text-gray-400" />
                                                                )
                                                            ) : (
                                                                <SortIcon className="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100" />
                                                            )}
                                                        </span>
                                                    </div>
                                                </th>
                                            ))}
                                        </tr>
                                    ))}
                                </thead>
                                <tbody
                                    {...getTableBodyProps()}
                                    className="bg-white divide-y divide-gray-200"
                                >
                                    {page.map((row, i) => {
                                        prepareRow(row);
                                        return (
                                            <tr {...row.getRowProps()}>
                                                {row.cells.map((cell) => {
                                                    return (
                                                        <td
                                                            {...cell.getCellProps()}
                                                            className="px-2 text-[16px] text-start py-4 whitespace-nowrap"
                                                        >
                                                            {cell.render("Cell")}
                                                        </td>
                                                    );
                                                })}
                                            </tr>
                                        );
                                    })}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {activeTab === "Orders" &&
                <div className="py-3 flex items-center justify-between">
                    <div className="flex-1 flex justify-between sm:hidden">
                        <Button onClick={() => previousPage()} disabled={!canPreviousPage}>
                            Previous
                        </Button>
                        <Button onClick={() => nextPage()} disabled={!canNextPage}>
                            Next
                        </Button>
                    </div>
                    <div className={`hidden sm:flex-1 sm:flex sm:items-center sm:justify-between gap-2 ${divWidth <= 366 ? "flex-wrap !justify-center items-center mt-4 gap-4" : ""}`}>
                        <div className="flex gap-x-5 items-center">
                            {preGlobalFilteredRows.length >= 5 &&
                                <label className={`flex justify-between gap-x-2 items-center relative`}>
                                    <div className={`text-gray-300 absolute inset-y-0 ${Language == 'en' ? 'right-0' : 'left-0'} flex items-center pe-3 pointer-events-none`}>
                                        <IoIosArrowDown />
                                    </div>
                                    <select
                                        className="text-[14px] bg-[var(--secondary)] min-w-[100px] p-2 rounded-full px-4 appearance-none"
                                        value={state.pageSize}
                                        onChange={(e) => {
                                            setPageSize(Number(e.target.value));
                                        }}
                                    >
                                        {[5, 10, 20].map((pageSize) => (
                                            <option key={pageSize} value={pageSize}>
                                                {t("show")} {pageSize}
                                            </option>
                                        ))}
                                    </select>
                                </label>
                            }
                            <span className="text-sm text-gray-700">
                                {t("page")} <span className="font-medium">{state.pageIndex + 1}</span> {t("of")}{" "}
                                <span className="font-medium">{pageOptions.length}</span>
                            </span>
                        </div>
                        <div>
                            <nav
                                className="relative z-0 inline-flex -space-x-px"
                                aria-label="Pagination"
                            >
                                <PageButton
                                    style={Language === "en" ? {
                                        borderTopLeftRadius: GlobalShape,
                                        borderBottomLeftRadius: GlobalShape,
                                        color: GlobalColor
                                    } : {
                                        borderTopRightRadius: GlobalShape,
                                        borderBottomRightRadius: GlobalShape,
                                        color: GlobalColor
                                    }}
                                    onClick={() => gotoPage(0)}
                                    disabled={!canPreviousPage}
                                >
                                    {Language === "en" ?
                                        <BsChevronDoubleLeft className="h-5 w-5" aria-hidden="true" />
                                        :
                                        <BsChevronDoubleRight className="h-5 w-5" aria-hidden="true" />

                                    }
                                </PageButton>
                                <PageButton
                                    style={{ color: GlobalColor }}
                                    onClick={() => previousPage()}
                                    disabled={!canPreviousPage}
                                >
                                    {Language === "en" ?
                                        <BsChevronLeft className="h-5 w-5" aria-hidden="true" />
                                        :
                                        <BsChevronRight className="h-5 w-5" aria-hidden="true" />
                                    }
                                </PageButton>
                                <PageButton
                                    style={{ color: GlobalColor }}
                                    onClick={() => nextPage()}
                                    disabled={!canNextPage}
                                >
                                    {Language === "en" ?
                                        <BsChevronRight className="h-5 w-5" aria-hidden="true" />
                                        :
                                        <BsChevronLeft className="h-5 w-5" aria-hidden="true" />
                                    }
                                </PageButton>
                                <PageButton
                                    onClick={() => gotoPage(pageCount - 1)}
                                    disabled={!canNextPage}
                                    style={Language === "en" ? {
                                        borderTopRightRadius: GlobalShape,
                                        borderBottomRightRadius: GlobalShape,
                                        color: GlobalColor
                                    } : {
                                        borderTopLeftRadius: GlobalShape,
                                        borderBottomLeftRadius: GlobalShape,
                                        color: GlobalColor
                                    }}
                                >
                                    {Language === "en" ?
                                        <BsChevronDoubleRight
                                            className="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        :
                                        <BsChevronDoubleLeft
                                            className="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    }
                                </PageButton>
                            </nav>
                        </div>
                    </div>
                </div>
            }
        </>
    );
}

export default Table;
