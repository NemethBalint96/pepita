"use client"

import FullCalendar from "@fullcalendar/react"
import dayGridPlugin from "@fullcalendar/daygrid"
import interactionPlugin from "@fullcalendar/interaction"
import { DateSelectArg, EventContentArg } from "@fullcalendar/core/index.js"
import rrulePlugin from "@fullcalendar/rrule"
import timeGridPlugin from "@fullcalendar/timegrid"
import { useEffect, useState } from "react"

const Calendar = () => {
  const [appointments, setAppointments] = useState([])

  useEffect(() => {
    fetch("http://localhost:8000/api/appointments")
      .then((response) => response.json())
      .then((data) => setAppointments(data.appointments))
  }, [])

  const handleSelect = (arg: DateSelectArg) => {
    if (window.prompt("What is your name?")) {
      console.log(arg.start)
    }
    // arg.view.calendar.unselect()
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
      plugins={[dayGridPlugin, interactionPlugin, rrulePlugin, timeGridPlugin]}
      initialView="dayGridMonth"
      allDaySlot={false}
      events={appointments}
      selectable={true}
      selectMirror={true}
      select={handleSelect}
      eventContent={renderEventContent}
      headerToolbar={{ right: "dayGridMonth,timeGridWeek,timeGridDay", left: "prev,today,next", center: "title" }}
    />
  )
}

export default Calendar
