import { ColumnDef } from "@tanstack/react-table";
import { Checkbox } from "../../components/ui/checkbox";
import { ArrowUpDown, Link, MoreHorizontal, Trash2Icon } from "lucide-react";
import { Button } from "../../components/ui/button";
import { DataTable } from "../../components/tables/data-table";
import {
  useDeleteArchive,
  useDownloadArchives,
  useFetchPatientArchives,
  useUndoArchive,
} from "../../services/archive-services";
import { Patient } from "../../schemas/patient-interfaces";
import useInvalidateSession from "../../hooks/use-invalidate";
import { CardContent, CardHeader, CardTitle } from "../../components/ui/card";
import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "../../components/ui/avatar";
import {
  DropdownMenu,
  DropdownMenuTrigger,
  DropdownMenuContent,
  DropdownMenuLabel,
  DropdownMenuItem,
  DropdownMenuSeparator,
} from "../../components/ui/dropdown-menu";
import { ResetIcon } from "@radix-ui/react-icons";

export default function ArchivedPatients() {
  const { data, isError } = useFetchPatientArchives();
  const { mutate: mutateDelete } = useDeleteArchive();
  const { mutate: mutateUndo } = useUndoArchive();
  const { invalidate } = useInvalidateSession();

  if (isError) invalidate();

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

    {
      id: "actions",
      enableHiding: false,
      cell: ({ row }) => {
        const entity = row.original;

        return (
          <DropdownMenu>
            <DropdownMenuTrigger asChild>
              <Button variant="ghost" className="h-8 w-8 p-0">
                <span className="sr-only">Open menu</span>
                <MoreHorizontal />
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
              <DropdownMenuLabel>Actions</DropdownMenuLabel>
              <DropdownMenuItem>
                <Link to={`/patients/archives/${row.getValue("patientId")}`}>
                  View Profile
                </Link>
              </DropdownMenuItem>
              <DropdownMenuSeparator />
              <DropdownMenuItem onClick={() => mutateUndo(entity)}>
                <ResetIcon /> Restore Patient
              </DropdownMenuItem>
              <DropdownMenuItem
                className="text-red-500"
                onClick={() => mutateDelete(entity.patientId)}
              >
                <Trash2Icon /> Delete Archive
              </DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>
        );
      },
    },
  ];

  return (
    <>
      <CardHeader>
        <CardTitle className="text-red-700">Archived Patients</CardTitle>
      </CardHeader>
      <CardContent>
        <DataTable
          useDownload={useDownloadArchives}
          data={data}
          columns={columns}
        />
      </CardContent>
    </>
  );
}
