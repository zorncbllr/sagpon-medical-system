import { ReactElement } from "react";
import { AppSidebar } from "../components/navigation/app-sidebar";
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from "./../components/ui/breadcrumb";
import { Separator } from "./../components/ui/separator";
import {
  SidebarInset,
  SidebarProvider,
  SidebarTrigger,
} from "./../components/ui/sidebar";
import { Link } from "react-router-dom";

export default function LayoutProvider({
  children,
}: {
  children: ReactElement;
}) {
  const uri = window.location.pathname;
  const paths = uri.split("/").filter((_, i) => i !== 0);

  const getHref = (index: number): string => {
    let temp = "";
    paths.forEach((p, i) => {
      temp += i <= index ? `/${p}` : "";
    });
    return temp;
  };

  return (
    <SidebarProvider>
      <AppSidebar />
      <SidebarInset>
        <header className="flex h-16 shrink-0 items-center gap-2">
          <div className="flex items-center gap-2 px-4">
            <SidebarTrigger className="-ml-1" />
            <Separator orientation="vertical" className="mr-2 h-4" />
            <Breadcrumb>
              <BreadcrumbList>
                {paths.map((path, index) => (
                  <div className="flex w-fit items-center gap-4">
                    <BreadcrumbItem className="hidden md:block">
                      <BreadcrumbLink className="capitalize">
                        <Link to={getHref(index)}>{path}</Link>
                      </BreadcrumbLink>
                    </BreadcrumbItem>{" "}
                    {index != paths.length - 1 && (
                      <BreadcrumbSeparator className="hidden md:block" />
                    )}
                  </div>
                ))}
              </BreadcrumbList>
            </Breadcrumb>
          </div>
        </header>
        <main className="w-full">{children}</main>
      </SidebarInset>
    </SidebarProvider>
  );
}
