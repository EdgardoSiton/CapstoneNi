<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/> <!-- DESIGN -->


  <script src="assets/js/dash.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="../css/calendar.css">
      
  <title>Calendar with Events</title>
</head>
<body>
<style> 
.blue {
  background: rgba(156, 202, 235, 1);
}
.orange {
  background: rgba(247, 167, 0, 1);
}
.green {
  background: rgba(153, 198, 109, 1);
}
.yellow {
  background: rgba(249, 233, 0, 1);
}
.pink {
  background: rgba(255, 192, 203, 1);
}
</style>

<div class="container">
  <div id="calendar"></div>
  
</div>
<?php
include_once "../../Model/db_connection.php";
include_once "../../Model/staff_mod.php";

try {
    $eventFetcher = new Staff($conn);
    
    // Attempt to fetch events
    $marriageEvents = $eventFetcher->fetchMarriageEvents();
    $baptismEvents = $eventFetcher->fetchBaptismEvents();
    $confirmationEvents = $eventFetcher->fetchConfirmationEvents();
    $defuctomEvents = $eventFetcher->fetchDefuctomEvents();
    $massEvents = $eventFetcher->fetchMassEvents();
    $addcalendar = $eventFetcher-> fetchAddCalendar();

    // Process or display the events as needed
    // Example: var_dump($marriageEvents);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>

<script>
!function() {
  var events = [
    <?php
    function convertTo12HourFormat($time) {
        return date("g:i A", strtotime($time));
    }

    // Mass Events
    foreach ($massEvents as $event) {
    ?>
    {
        eventName: '<?php echo $event['title']; ?>',
        startTime: '<?php echo convertTo12HourFormat($event['start_time']); ?>',
        endTime: '<?php echo convertTo12HourFormat($event['end_time']); ?>',
        calendar: 'Announcement Event',
        color: 'pink',
        date: '<?php echo $event['date']; ?>'
    },
    <?php } ?>
   <?php
foreach ($addcalendar as $event) {
    // Extract month and day from the event date
    $eventDate = new DateTime($event['cal_date']);
    $month = $eventDate->format('m');
    $day = $eventDate->format('d');
    
    // Loop through each year
    for ($year = 2024; $year <= 2100; $year++) { // Adjust the range as needed
        // Format the new date
        $newDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
        ?>
        {
            eventName: '<?php echo $event['cal_fullname']; ?>',
            startTime: '<?php echo $event['cal_Category']; ?>',
            endTime: '<?php echo $event['cal_description']; ?>',
            calendar: 'Events in Church',
            color: 'blue',
            date: '<?php echo $newDate; ?>'
        },
        <?php 
    } 
} 
?>

    // Marriage Events
    <?php
    foreach ($marriageEvents as $event) {
    ?>
    {
        eventName: '<?php echo $event['Event_Name']; ?>',
        startTime: '<?php echo convertTo12HourFormat($event['schedule_starttime']); ?>',
        endTime: '<?php echo convertTo12HourFormat($event['schedule_endtime']); ?>',
        calendar: 'Marriage',
        color: 'orange',
        date: '<?php echo $event['schedule_date']; ?>'
    },
    <?php } ?>

    // Baptism Events
    <?php
    foreach ($baptismEvents as $event) {
    ?>
    {
        eventName: '<?php echo $event['Event_Name']; ?>',
        startTime: '<?php echo convertTo12HourFormat($event['schedule_starttime']); ?>',
        endTime: '<?php echo convertTo12HourFormat($event['schedule_endtime']); ?>',
        calendar: 'Baptism',
        color: 'blue',
        date: '<?php echo $event['schedule_date']; ?>'
    },
    <?php } ?>

    // Confirmation Events
    <?php
    foreach ($confirmationEvents as $event) {
    ?>
    {
        eventName: '<?php echo $event['Event_Name']; ?>',
        startTime: '<?php echo convertTo12HourFormat($event['schedule_starttime']); ?>',
        endTime: '<?php echo convertTo12HourFormat($event['schedule_endtime']); ?>',
        calendar: 'Confirmation',
        color: 'green',
        date: '<?php echo $event['schedule_date']; ?>'
    },
    <?php } ?>

    // Defuctom Events
    <?php
    foreach ($defuctomEvents as $event) {
    ?>
    {
        eventName: '<?php echo $event['Event_Name']; ?>',
        startTime: '<?php echo convertTo12HourFormat($event['schedule_starttime']); ?>',
        endTime: '<?php echo convertTo12HourFormat($event['schedule_endtime']); ?>',
        calendar: 'Defuctom',
        color: 'yellow',
        date: '<?php echo $event['schedule_date']; ?>'
    },
    <?php } ?>
  ];

    

    function Calendar(selector, events) {
      this.el = document.querySelector(selector);
      this.events = events;
      this.current = moment().date(1);
      this.draw();
      var current = document.querySelector('.today');
      if (current) {
        var self = this;
        window.setTimeout(function() {
          self.openDay(current);
        }, 500);
      }
    }

    Calendar.prototype.draw = function() {
      // Create Header
      this.drawHeader();

      // Draw Month
      this.drawMonth();

      this.drawLegend();
    }

    Calendar.prototype.drawHeader = function() {
      var self = this;
      if (!this.header) {
        // Create the header elements
        this.header = createElement('div', 'header');
        this.header.className = 'header';

        this.title = createElement('h1');

        var right = createElement('div', 'right');
        right.addEventListener('click', function() { self.nextMonth(); });

        var left = createElement('div', 'left');
        left.addEventListener('click', function() { self.prevMonth(); });

        // Append the Elements
        this.header.appendChild(this.title);
        this.header.appendChild(right);
        this.header.appendChild(left);
        this.el.appendChild(this.header);
      }

      this.title.innerHTML = this.current.format('MMMM YYYY');
    }

    Calendar.prototype.drawMonth = function() {
      var self = this;

      this.events.forEach(function(ev) {
            ev.date = moment(ev.date, 'YYYY-MM-DD');
      
        });

      if (this.month) {
        this.oldMonth = this.month;
        this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'prev');
        this.oldMonth.addEventListener('webkitAnimationEnd', function() {
          self.oldMonth.parentNode.removeChild(self.oldMonth);
          self.month = createElement('div', 'month');
          self.backFill();
          self.currentMonth();
          self.forwardFill();
          self.el.appendChild(self.month);
          window.setTimeout(function() {
            self.month.className = 'month in ' + (self.next ? 'next' : 'prev');
          }, 16);
        });
      } else {
        this.month = createElement('div', 'month');
        this.el.appendChild(this.month);
        this.backFill();
        this.currentMonth();
        this.forwardFill();
        this.month.className = 'month new';
      }
    }

    Calendar.prototype.backFill = function() {
      var clone = this.current.clone();
      var dayOfWeek = clone.day();

      if (!dayOfWeek) { return; }

      clone.subtract('days', dayOfWeek + 1);

      for (var i = dayOfWeek; i > 0; i--) {
        this.drawDay(clone.add('days', 1));
      }
    }

    Calendar.prototype.forwardFill = function() {
      var clone = this.current.clone().add('months', 1).subtract('days', 1);
      var dayOfWeek = clone.day();

      if (dayOfWeek === 6) { return; }

      for (var i = dayOfWeek; i < 6; i++) {
        this.drawDay(clone.add('days', 1));
      }
    }

    Calendar.prototype.currentMonth = function() {
      var clone = this.current.clone();

      while (clone.month() === this.current.month()) {
        this.drawDay(clone);
        clone.add('days', 1);
      }
    }

    Calendar.prototype.getWeek = function(day) {
      if (!this.week || day.day() === 0) {
        this.week = createElement('div', 'week');
        this.month.appendChild(this.week);
      }
    }

    Calendar.prototype.drawDay = function(day) {
      var self = this;
      this.getWeek(day);

      // Outer Day
      var outer = createElement('div', this.getDayClass(day));
      outer.addEventListener('click', function() {
        self.openDay(this);
      });

      // Day Name
      var name = createElement('div', 'day-name', day.format('ddd'));

      // Day Number
      var number = createElement('div', 'day-number', day.format('DD'));


      // Events
      var events = createElement('div', 'day-events');
      this.drawEvents(day, events);

      outer.appendChild(name);
      outer.appendChild(number);
      outer.appendChild(events);
      this.week.appendChild(outer);
    }

    Calendar.prototype.drawEvents = function(day, element) {
      if (day.month() === this.current.month()) {
        var todaysEvents = this.events.reduce(function(memo, ev) {
          if (ev.date.isSame(day, 'day')) {
            memo.push(ev);
          }
          return memo;
        }, []);

        todaysEvents.forEach(function(ev) {
          var evSpan = createElement('span', ev.color);
          element.appendChild(evSpan);
        });
      }
    }

    Calendar.prototype.getDayClass = function(day) {
      var classes = ['day'];
      if (day.month() !== this.current.month()) {
        classes.push('other');
      } else if (moment().isSame(day, 'day')) {
        classes.push('today');
      }
      return classes.join(' ');
    }

    Calendar.prototype.openDay = function(el) {
      var details, arrow;
      var dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
      var day = this.current.clone().date(dayNumber);

      var currentOpened = document.querySelector('.details');

      // Check to see if there is an open details box on the current row
      if (currentOpened && currentOpened.parentNode === el.parentNode) {
        details = currentOpened;
        arrow = document.querySelector('.arrow');
      } else {
        // Close the open events on different week row
        // currentOpened && currentOpened.parentNode.removeChild(currentOpened);
        if (currentOpened) {
          currentOpened.addEventListener('webkitAnimationEnd', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('oanimationend', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('msAnimationEnd', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('animationend', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.className = 'details out';
        }

        // Create the Details Container
        details = createElement('div', 'details in');

        // Create the arrow
        var arrow = createElement('div', 'arrow');

        // Create the event wrapper

        details.appendChild(arrow);
        el.parentNode.appendChild(details);
      }

      var todaysEvents = this.events.reduce(function(memo, ev) {
        if (ev.date.isSame(day, 'day')) {
          memo.push(ev);
        }
        return memo;
      }, []);

      this.renderEvents(todaysEvents, details);

      arrow.style.left = el.offsetLeft - el.parentNode.offsetLeft + -35 + 'px';
    }

    Calendar.prototype.renderEvents = function(events, ele) {
      // Remove any events in the current details element
      var currentWrapper = ele.querySelector('.events');
      var wrapper = createElement('div', 'events in' + (currentWrapper ? ' new' : ''));

      events.forEach(function(ev) {
    var div = createElement('div', 'event');
    var square = createElement('div', 'event-category ' + ev.color);
    var eventNameSpan = createElement('span', '', 'Event: ' + ev.eventName );
    var startTimeSpan = createElement('span', '', ' ' + ev.startTime );
    var endTimeSpan = createElement('span', '', '- ' + ev.endTime );
    
    div.appendChild(square);
    div.appendChild(eventNameSpan);
    div.appendChild(startTimeSpan);
    div.appendChild(endTimeSpan);
    wrapper.appendChild(div);
});


      if (!events.length) {
        var div = createElement('div', 'event empty');
        var span = createElement('span', '', 'No Events');

        div.appendChild(span);
        wrapper.appendChild(div);
      }

      if (currentWrapper) {
        currentWrapper.className = 'events out';
        currentWrapper.addEventListener('webkitAnimationEnd', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
        currentWrapper.addEventListener('oanimationend', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
        currentWrapper.addEventListener('msAnimationEnd', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
        currentWrapper.addEventListener('animationend', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
      } else {
        ele.appendChild(wrapper);
      }
    }

    Calendar.prototype.drawLegend = function() {
      var legend = createElement('div', 'legend');
      var calendars = this.events.map(function(e) {
        return e.calendar + '|' + e.color;
      }).reduce(function(memo, e) {
        if (memo.indexOf(e) === -1) {
          memo.push(e);
        }
        return memo;
      }, []).forEach(function(e) {
        var parts = e.split('|');
        var entry = createElement('span', 'entry ' + parts[1], parts[0]);
        legend.appendChild(entry);
      });
      this.el.appendChild(legend);
    }

    Calendar.prototype.nextMonth = function() {
      this.current.add('months', 1);
      this.next = true;
      this.draw();
    }

    Calendar.prototype.prevMonth = function() {
      this.current.subtract('months', 1);
      this.next = false;
      this.draw();
    }

    window.Calendar = Calendar;

    function createElement(tagName, className, innerText) {
      var ele = document.createElement(tagName);
      if (className) {
        ele.className = className;
      }
      if (innerText) {
        ele.innerText = ele.textContent = innerText;
      }
      return ele;
    }
    
    document.addEventListener('DOMContentLoaded', function() {
      var calendar = new Calendar('#calendar', events);
    });
  }();
</script>
</body>
</html>