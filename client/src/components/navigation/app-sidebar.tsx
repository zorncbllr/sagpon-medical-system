import * as React from "react";
import {
  BookOpen,
  Bot,
  Command,
  Frame,
  LifeBuoy,
  Map,
  PieChart,
  Send,
  Settings2,
  SquareTerminal,
} from "lucide-react";

import { NavMain } from "./nav-main";
import { NavProjects } from "./nav-projects";
import { NavSecondary } from "./nav-secondary";
import { NavUser } from "./nav-user";
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from "../ui/sidebar";
import { Link } from "react-router-dom";

const data = {
  user: {
    name: "shadcn",
    email: "m@example.com",
    avatar: "/avatars/shadcn.jpg",
  },
  navMain: [
    {
      title: "Dashboard",
      url: "/dashboard",
      icon: SquareTerminal,
      isActive: true,
    },
    {
      title: "Appointments",
      url: "/appointments",
      icon: Bot,
      items: [
        {
          title: "Schedule Appointment",
          url: "/book-appointments",
        },
        {
          title: "View Appointments",
          url: "/view-appointments",
        },
      ],
    },
    {
      title: "Patients",
      url: "/patients",
      icon: BookOpen,
      items: [
        {
          title: "Patient Registration",
          url: "/register",
        },
        {
          title: "Patient Profiles",
          url: "/patients/profiles",
        },
      ],
    },
    {
      title: "Doctors",
      url: "/doctors",
      icon: BookOpen,
      items: [
        {
          title: "Doctor Registration",
          url: "/doctors/register",
        },
        {
          title: "Doctor Profiles",
          url: "/doctors/profiles",
        },
      ],
    },
    {
      title: "Nurses",
      url: "/nurses",
      icon: BookOpen,
      items: [
        {
          title: "Nurse Registration",
          url: "/nurses/register",
        },
        {
          title: "Nurse Profiles",
          url: "/nurses/profiles",
        },
      ],
    },
    {
      title: "Staffs",
      url: "/staffs",
      icon: BookOpen,
      items: [
        {
          title: "Staff Registration",
          url: "/staffs/register",
        },
        {
          title: "Staff Profiles",
          url: "/staffs/profiles",
        },
      ],
    },
    {
      title: "Settings",
      url: "#",
      icon: Settings2,
      items: [
        {
          title: "General",
          url: "#",
        },
        {
          title: "Team",
          url: "#",
        },
        {
          title: "Billing",
          url: "#",
        },
        {
          title: "Limits",
          url: "#",
        },
      ],
    },
  ],
  navSecondary: [
    {
      title: "Support",
      url: "#",
      icon: LifeBuoy,
    },
    {
      title: "Feedback",
      url: "#",
      icon: Send,
    },
  ],
  projects: [
    {
      name: "Inventory",
      url: "#",
      icon: Frame,
    },
    {
      name: "Rooms",
      url: "#",
      icon: Frame,
    },
    {
      name: "Mails",
      url: "#",
      icon: PieChart,
    },
    {
      name: "Tasks",
      url: "#",
      icon: Map,
    },
  ],
};

export function AppSidebar({ ...props }: React.ComponentProps<typeof Sidebar>) {
  return (
    <Sidebar variant="inset" {...props}>
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton size="lg" asChild>
              <Link to="#">
                <div className="flex aspect-square size-8 items-center justify-center rounded-lg bg-primary text-sidebar-primary-foreground">
                  <Command color="white" className="size-4 bg-primary" />
                </div>
                <div className="grid flex-1 text-left text-sm leading-tight">
                  <span className="truncate font-semibold">
                    Sagpon Health Station
                  </span>
                  <span className="truncate text-xs">Enterprise</span>
                </div>
              </Link>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent>
        <NavMain items={data.navMain} />
        <NavProjects projects={data.projects} />
        <NavSecondary items={data.navSecondary} className="mt-auto" />
      </SidebarContent>
      <SidebarFooter>
        <NavUser user={data.user} />
      </SidebarFooter>
    </Sidebar>
  );
}
