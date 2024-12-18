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
import useInvalidateSession from "../../hooks/use-invalidate";
import { CardContent, CardHeader, CardTitle } from "../../components/ui/card";
import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "../../components/ui/avatar";
import { useEffect } from "react";
import { usePatientStore } from "../../store/patients-store";

export function Patients() {
  const { data, isError } = useFetchPatients();
  const { mutate } = useDeletePatient();
  const { setPatientsData } = usePatientStore();
  const { invalidate } = useInvalidateSession();

  if (isError) invalidate();

  useEffect(() => {
    setPatientsData(data);
  }, [data]);

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
      accessorKey: "photo",
      header: "",
      cell: ({ row }) => (
        <Avatar>
          <AvatarImage>{row.getValue("photo")}</AvatarImage>
          <AvatarFallback />
        </Avatar>
      ),
    },
    {
      accessorKey: "firstName",
      header: "First Name",
      cell: ({ row }) => (
        <div className="capitalize w-10">{row.getValue("firstName")}</div>
      ),
    },
    {
      accessorKey: "middleName",
      header: "Middle Name",
      cell: ({ row }) => (
        <div className="capitalize">{row.getValue("middleName")}</div>
      ),
    },
    {
      accessorKey: "lastName",
      header: "Last Name",
      cell: ({ row }) => (
        <div className="capitalize w-[10rem]">{row.getValue("lastName")}</div>
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
      accessorKey: "birthDate",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Age
            <ArrowUpDown />
          </Button>
        );
      },
      cell: ({ row }) => {
        const age =
          new Date().getFullYear() -
          parseInt((row.getValue("birthDate") as string).split("-")[0]);

        return <div className="capitalize text-center">{age}</div>;
      },
    },
    {
      accessorKey: "gender",
      header: ({ column }) => {
        return (
          <Button
            variant="ghost"
            onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
          >
            Gender
            <ArrowUpDown />
          </Button>
        );
      },
      cell: ({ row }) => (
        <div className="capitalize text-center">{row.getValue("gender")}</div>
      ),
    },

    getTableActions({ entityprop: "patient", mutate }),
  ];

  return (
    <>
      <CardHeader>
        <CardTitle>Patient Records</CardTitle>
      </CardHeader>
      <CardContent>
        <DataTable filter="email" data={data} columns={columns} />
      </CardContent>
    </>
  );
}
