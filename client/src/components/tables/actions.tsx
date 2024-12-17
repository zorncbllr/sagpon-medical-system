import { Edit2Icon, MoreHorizontal, Trash2Icon } from "lucide-react";
import { Button } from "../ui/button";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "../ui/dropdown-menu";
import { Row } from "@tanstack/react-table";
import { Link, useNavigate } from "react-router-dom";
import { UseMutateFunction } from "@tanstack/react-query";
import { AxiosResponse } from "axios";

export function getTableActions<T>({
  entityprop,
  mutate,
}: {
  entityprop: string;
  mutate: UseMutateFunction<AxiosResponse<any, any>, Error, string, unknown>;
}) {
  return {
    id: "actions",
    enableHiding: false,
    cell: ({ row }: { row: Row<T> }) => {
      const entity = row.original;
      const entityCapitalized =
        entityprop.charAt(0).toUpperCase() + entityprop.slice(1);
      const entityId = eval(`entity.${entityprop}Id;`);

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
              <Link to={`/${entityprop}s/${entityId}/profile`}>
                View Profile
              </Link>
            </DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem>
              <Edit2Icon /> Update Details
            </DropdownMenuItem>
            <DropdownMenuItem
              className="text-red-500"
              onClick={() => mutate(entityId)}
            >
              <Trash2Icon /> Delete
              {entityCapitalized}
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      );
    },
  };
}
