"use client";

import { ColumnDef } from "@tanstack/react-table";
import { Checkbox } from "../../components/ui/checkbox";
import { ArrowUpDown } from "lucide-react";
import { Button } from "../../components/ui/button";
import { DataTable } from "../../components/tables/data-table";
import {
  useDeletePatient,
  useFetchPatients,
} from "../../services/patient-service";
import { Patient } from "../../schemas/patient-interfaces";
import { getTableActions } from "../../components/tables/actions";

export function Patients() {
  const { data } = useFetchPatients();
  const { mutate } = useDeletePatient();

  const columns: ColumnDef<Patient>[] = [
    {
      id: "select",
      header: ({ table }) => (
        <Checkbox
          checked={
            table.getIsAllPageRowsSelected() ||
            (table.getIsSomePageRowsSelected() && "indeterminate")
          }
          onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
          aria-label="Select all"
        />
      ),
      cell: ({ row }) => (
        <Checkbox
          checked={row.getIsSelected()}
          onCheckedChange={(value) => row.toggleSelected(!!value)}
          aria-label="Select row"
        />
      ),
      enableSorting: true,
      enableHiding: true,
    },
    {
      accessorKey: "firstName",
      header: "Status",
      cell: ({ row }) => (
        <div className="capitalize">{row.getValue("firstName")}</div>
      ),
    },
    {
      accessorKey: "email",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Email
            <ArrowUpDown />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className="lowercase">{row.getValue("email")}</div>
      ),
    },
    {
      accessorKey: "address",
      header: () => <div className="text-right">Amount</div>,
      cell: ({ row }) => {
        return (
          <div className="text-right font-medium">
            {row.getValue("address")}
          </div>
        );
      },
    },

    getTableActions({ entityprop: "patient", mutate }),
  ];

  return <DataTable filter="email" data={data} columns={columns} />;
}
