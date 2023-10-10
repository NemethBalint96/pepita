"use client"

import FullCalendar from "@fullcalendar/react"
import dayGridPlugin from "@fullcalendar/daygrid"
import interactionPlugin, { DateClickArg } from "@fullcalendar/interaction"
import { EventContentArg } from "@fullcalendar/core/index.js"

const Calendar = () => {
  const handleDateClick = (arg: DateClickArg) => {
    alert(arg.dateStr)
  }

  const renderEventContent = (eventInfo: EventContentArg) => {
    return (
      <>
        <b>{eventInfo.timeText}</b>
        <i>{eventInfo.event.title}</i>
      </>
    )
  }

  return (
    <FullCalendar
      plugins={[dayGridPlugin, interactionPlugin]}
      initialView="dayGridMonth"
      events={[
        { title: "event 1", date: "2023-10-01" },
        { title: "event 2", date: "2023-10-02" },
      ]}
      dateClick={handleDateClick}
      eventContent={renderEventContent}
      headerToolbar={{ right: "dayGridMonth,dayGridWeek,dayGridDay", center: "prev,today,next" }}
    />
  )
}

export default Calendar
